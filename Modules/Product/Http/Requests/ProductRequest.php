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
            'special_price' => 'السعر للعملاء المميزين'
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
