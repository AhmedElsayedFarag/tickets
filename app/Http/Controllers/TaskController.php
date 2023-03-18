<?php

namespace App\Http\Controllers;

use App\Actions\DataTable;
use App\Actions\GetUserTasks;
use App\Actions\SendFireBaseNotification;
use App\Http\Requests\Task\CreateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view tasks')->only('index');
        $this->middleware('permission:create tasks')->only(['create', 'store']);
        $this->middleware('permission:update tasks')->only(['edit', 'update']);
        $this->middleware('permission:delete tasks')->only('destroy');
    }

    public function index()
    {

        if (request()->ajax()) {
            return app()->call(new DataTable(app()->call(new GetUserTasks())));
        } else {
            return view('tasks.index');
        }
    }


    public function create()
    {
        return view('tasks.create');
    }


    public function store(CreateRequest $request)
    {
        $task = Task::create($request->validated());
        app()->call(new SendFireBaseNotification('تذكرة جديدة',$task->text,1));
        Session::flash('message', 'Saved Successfully');
        return redirect()->route('tasks.index');
    }


    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task, 'employees' => auth()->user()->department->employees ?? []]);
    }


    public function update(CreateRequest $request, Task $task)
    {
        $task->update($request->validated());
        app()->call(new SendFireBaseNotification("تم التعديل على $task->text",$task->status,1));
        app()->call(new SendFireBaseNotification("تم التعديل على $task->text",$task->status,$task->user_id));
        Session::flash('message', 'Updated Successfully');
        return redirect()->back();
    }


    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->back();
    }
}
