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
            'image' => $this->isMethod('post') ? ['required' , 'image' , 'max:2024'] : ['image' , 'max:2024'],
            'name' => ['required' , 'string' , 'max:255'],
            'quantity' => ['required' , 'numeric' , 'gt:0'],
            'description' => ['required' , 'string' , 'max:255'],
            'price' => ['required' , 'numeric'],
            'maximum' => ['required' , 'numeric' , 'lt:'.$this->quantity],
            'description1' => ['required' , 'string' , 'max:255'],
            'price1' => ['required' , 'numeric'],
            'maximum1' => ['required' , 'numeric' , 'lt:'.$this->quantity],
            'description2' => ['required' , 'string' , 'max:255'],
            'price2' => ['required' , 'numeric'],
            'maximum2' => ['required' , 'numeric' , 'lt:'.$this->quantity],
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'الصورة',
            'name' => 'الإسم',
            'category_id' => 'القسم',
            'quantity' => 'الكمية',
            'description' => 'الوصف لكبار العملاء',
            'price' => 'السعر لكبار العملاء',
            'maximum' => 'أكبر قيمة للطلب لكبار العملاء',
            'description1' => 'الوصف لعملاء الجملة',
            'price1' => 'السعر لعملاء الجملة',
            'maximum1' => 'أكبر قيمة للطلب لعملاء الجملة',
            'description2' => 'الوصف لكبار لعملاء القطاعي',
            'price2' => 'السعر لكبار لعملاء القطاعي',
            'maximum2' => 'أكبر قيمة للطلب لعملاء القطاعي'
        ];   
    }

    public function messages()
    {
        return [
            'quantity.gt' => 'الكمية يجب أن تكون أكبر من 0',
            // 'minimum.lt' => 'أقل كمية للطلب يجب أن تكون أقل من :attribute',
            'maximum.lt' => 'أقصي كمية للطلب يجب أن تكون أقل من :attribute'
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
