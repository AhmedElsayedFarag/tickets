<?php


namespace App\Actions;


use App\Models\Task;

class GetUserTasks extends Action
{
    public function __invoke()
    {
        return match (auth()->user()->getRoleNames()[0]) {
            'admin' => Task::query(),
            'employee' => Task::query()->where('user_id', auth()->id()),
            default => abort(403),
        };
    }

}
