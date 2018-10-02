<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|confirmed',
            'image' => 'nullable|image',
            'phone' => 'required|phone',
            'address' => 'required|min:3|max:191',
            'city' => 'required|min:3|max:191',
        ];
    }

    /**
    * Get the proper failed validation response for the request.
    *
    * @param  array  $errors
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 422);
        }
        alert()->error('Validation errors !' , 'Error');
        return $this->redirector->to($this->getRedirectUrl())
        ->withInput($this->except($this->dontFlash))
        ->withErrors($errors, $this->errorBag);
    }
}
