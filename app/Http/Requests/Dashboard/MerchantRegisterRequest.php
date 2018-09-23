<?php
namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRegisterRequest extends FormRequest
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
      		'email'=>'unique:merchants,email',
            'phone' => [
                'required' , 'regex:"^([\+0]([0-9]+[\- ]?)+)$"'
            ]
        ];
    }
}
