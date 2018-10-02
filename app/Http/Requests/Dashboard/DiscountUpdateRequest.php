<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DiscountUpdateRequest extends FormRequest
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
             'product_id' => 'required|exists:products,id',
             'percentage' => 'required|min:0',
             'activation_start' => 'date',
             'activation_end' => 'date'
         ];
     }
}
