<?php
namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'image'=>'image',
            'phone'=>'regex:/^([\+0]([0-9]+[\- ]?)+)$/',
            'company'=>'nullable',
            'address'=>'nullable',
            'country_id'=>'required',
        ];
    }

}
