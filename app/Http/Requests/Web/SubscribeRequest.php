<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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
            'subemail' => 'required|email'
        ];
    }

    public function attributes()
    {
        return [
            'subemail' => 'subscriber\'s email',
        ];
    }

    public function messages()
    {
        return [
            'subemail.required' => 'The :attribute must be a valid email address.',
        ];
    }
}
