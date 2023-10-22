<?php

namespace Modules\User\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Password;

class UserRequest extends FormRequest
{

    protected function onCreate()
    {
        $data = [
            'name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'string' , 'max:255' , 'email' , 'unique:users,email'],
            'mobile' => ['required'],
            'password' => ['required','string',Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'type' => ['required'],
            'facility_name' => ['required' , 'string' , 'max:255'],
            'facility_number' => ['required' , 'numeric'],
            'city' => ['required' , 'string'],
            'district' => ['required' , 'string'],
            'street' => ['required' , 'string' , 'max:255'],
            'floor' => ['required' , 'numeric'],
        ];

        return $data;

    }

    protected function onUpdate()
    {
        $user = $this->user;
        $data = [
            'name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'string' , 'max:255' , 'email' , 'unique:users,email,'.$user->id],
            'mobile' => ['required'],
            'password' => $this->password ? ['string',Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()] : '',
            'type' => ['required'],
            'facility_name' => ['required' , 'string' , 'max:255'],
            'facility_number' => ['required' , 'numeric'],
            'city' => ['required' , 'string'],
            'district' => ['required' , 'string'],
            'street' => ['required' , 'string' , 'max:255'],
            'floor' => ['required' , 'numeric'],
        ];

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->isMethod('post') ? $this->onCreate() : $this->onUpdate();
    }

    /**
     * get the validation attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'الإسم ',
            'email' => 'البريد الإلكتروني',
            'password' => 'الرقم السري',
            'facility_name' => 'إسم المنشأة',
            'city' => 'المحافظة',
            'district' => 'المنطقة',
            'street' => 'إسم الشارع',
            'facility_number' => 'رقم المنشأة',
            'floor' => 'رقم الدور',
            'mobile' => 'رقم الموبايل',
            'type' => 'نوع العميل'
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
