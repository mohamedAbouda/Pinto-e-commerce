<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
{
    function __construct()
    {
        \Validator::extend('checkUrl', function($attribute, $value, $parameters) {
            return filter_var($value, FILTER_VALIDATE_URL);
        } ,"Wrong url format for :attribute");

        \Validator::extend('phones', function($attribute, $value, $parameters) {
            $phones = explode(',' ,$value);
            foreach ($phones as $phone) {
                if (!preg_match("/^([\+0]([0-9]+[\- ]?)+)$/",$phone)) {
                    return false;
                }
            }
            return true;
        } ,"Wrong phne format for one of the phones");
    }
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
            'phones' => [
                'nullable' , 'phones'
            ],
            'email' => 'nullable|email',
            'twitter' => 'nullable|checkUrl',
            'instagram' => 'nullable|checkUrl',
            'facebook' => 'nullable|checkUrl',
            'google' => 'nullable|checkUrl',
        ];
    }
}
