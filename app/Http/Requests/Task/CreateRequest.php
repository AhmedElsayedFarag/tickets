<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text'=>['required','string','max:255'],
            'status'=>['required','string','max:30'],
            'user_id'=>['required'],
            'image'=>['mimes:jpg,bmp,png','file','max:1024'],
        ];
    }
    protected function prepareForValidation()
    {
        $this->request->add(['user_id'=>auth()->id()]);
    }
}
