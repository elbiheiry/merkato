<?php

namespace Modules\User\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'region' => ['required' , 'string' , 'max:255'],
            'area' => ['required' , 'string' , 'max:255'],
            'address' => ['required' , 'string' , 'max:255'],
            'facility' => ['required' , 'numeric'],
            'floor' => ['required' , 'numeric'],
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
            'region' => 'المحافظة',
            'area' => 'المنطقة',
            'address' => 'إسم الشارع',
            'facility' => 'رقم المنشأة',
            'floor' => 'الدور'
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
