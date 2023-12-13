<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['required' , 'not_in:0'],
            'type_id' => ['required' , 'not_in:0'],
            'image' => $this->isMethod('post') ? ['required' , 'image' , 'max:2024'] : ['image' , 'max:2024'],
            'name' => ['required' , 'string' , 'max:255'],
            'description' => ['required' , 'string' , 'max:255'],
            'price' => ['required' , 'numeric'],
            'quantity' => ['required' , 'numeric' , 'gt:0'],
            // 'minimum' => ['required' , 'numeric' , 'gt:0' , 'lt:'.$this->maximum , 'lt:'.$this->quantity],
            'maximum' => ['required' , 'numeric' , 'lt:'.$this->quantity , 'gt:'.$this->minimum]
            // 'special_price' => ['required' , 'numeric']
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'الصورة',
            'name' => 'الإسم',
            'category_id' => 'القسم',
            'type_id' => 'النوع',
            'description' => 'الوصف',
            'price' => 'السعر',
            'special_price' => 'السعر للعملاء المميزين',
            'quantity' => 'الكمية',
            // 'minimum' => 'أقل قيمة للطلب',
            'maximum' => 'أكبر قيمة للطلب'
        ];   
    }

    public function messages()
    {
        return [
            'quantity.gt' => 'الكمية يجب أن تكون أكبر من 0',
            // 'minimum.lt' => 'أقل كمية للطلب يجب أن تكون أقل من :attribute',
            'maximum.lt' => 'أقصي كمية للطلب يجب أن تكون أقل من :attribute',
            'maximum.gt' => 'أقصي كمية للطلب يجب أن تكون أكثر من :attribute',
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
