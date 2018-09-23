<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class OrderCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'nullable|regex:"/^([\+0]([0-9]+[\- ]?)+)$/"',
            'post_code' => 'nullable|numeric',
        ];
    }
}
