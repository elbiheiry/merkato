<?php

namespace Modules\Coupon\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required' , 'string' , 'max:255'],
            'max_usage' => ['required' , 'numeric'],
            'discount' => ['required' , 'numeric']
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'كود الخصم',
            'max_usage' => 'أقصي حد للإستخدام',
            'discount' => 'قيمة الخصم'
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
        throw new HttpResponseException(response()->json($validator->errors()->first(), 400));
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
