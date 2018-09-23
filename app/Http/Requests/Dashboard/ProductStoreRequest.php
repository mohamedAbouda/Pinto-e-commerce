<?php
namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
          // 'description'=>'required',
            'cover_image'=>'image',
            'price'=>'required|integer',
            'sub_category_id'=>'required',
            // 'size_id' => 'required',
            // 'color_id' => 'required',
            //'sku'=>'unique:products,sku'
        ];
    }
}
