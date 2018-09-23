<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'name'=>'required',
            'email'=>['required','unique:users,email','regex:/([a-zA-Z0-9._-]+@[a-zA-Z0-9_-]+([.][a-zA-Z0-9])+)/'],
            'password'=>'required|confirmed',
        ];
    }
}
