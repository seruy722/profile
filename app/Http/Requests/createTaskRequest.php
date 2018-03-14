<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createTaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'surname'=>'required|min:2|max:100',
            'name' => 'required|string|max:100|min:2',
            'card_of_bank'=>'digits:16|nullable',
            'email' => 'required|string|email|max:100|unique:tasks',
            'phone' => 'required|digits:10|unique:tasks',
            'comment'=>'nullable',
            'day'=>'required'
        ];
    }
}
