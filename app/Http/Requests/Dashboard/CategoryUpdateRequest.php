<?php
namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'icon' => 'required',
            'payment_withhold' => 'required|min:0',
            'payment_due_percentage' => 'required|min:0',
            'shipping_cost' => 'required|min:0',
        ];
    }
}
