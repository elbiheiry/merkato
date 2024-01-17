<?php

namespace Modules\Auth\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required' , 'string' , 'max:255'],
            'last_name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'string' , 'max:255' , 'email' , 'unique:users,email'],
            'password' => 'required','string',Password::min(8)->mixedCase()->numbers()->uncompromised(),
            'facility_name' => ['required' , 'string' , 'max:255'],
            'city' => ['required' , 'string'],
            'district' => ['required' , 'string'],
            'street' => ['required' , 'string' , 'max:255'],
            'facility_number' => ['required' , 'numeric'],
            'floor' => ['required' , 'numeric'],
            'mobile' => ['required']
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
            'first_name' => 'الإسم الأول',
            'last_name' => 'الإسم الأخر',
            'email' => 'البريد الإلكتروني',
            'password' => 'الرقم السري',
            'facility_name' => 'إسم المنشأة',
            'city' => 'المحافظة',
            'district' => 'المنطقة',
            'street' => 'إسم الشارع',
            'facility_number' => 'رقم المنشأة',
            'floor' => 'رقم الدور',
            'mobile' => 'رقم الموبايل'
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
