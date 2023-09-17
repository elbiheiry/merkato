<?php

namespace Modules\Auth\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required' , 'string' , 'max:255' , 'email' , 'exists:users,email'],
            'password' => ['required' , 'min:8']
        ];
    }

    /**
     * get the validation attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'البريد الإلكتروني',
            'password' => 'الرقم السري'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(api_response_error($validator->errors()->first()));
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
}
