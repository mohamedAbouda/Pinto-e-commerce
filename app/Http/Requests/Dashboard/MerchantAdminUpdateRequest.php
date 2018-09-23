<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MerchantAdminUpdateRequest extends FormRequest
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
        $rid = request()->resource_id;
        return [
            'name' => 'required',
            'email' => 'required|unique:merchants,email,'.$rid,
            'phone' => ['required','regex:/^(\+|00[\d]{1,4}[\d]{5,11})|([\d]{1,4}[\d]{5,11})$/'],
            'password' => 'nullable|confirmed',
        ];
    }
}
