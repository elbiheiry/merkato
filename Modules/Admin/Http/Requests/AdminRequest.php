<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminRequest extends FormRequest
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
     * on creation set validation rules
     *
     * @return array
     */
    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'max:225'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['not_in:0'],
        ];
    }

    /**
     * on update set validation rules
     *
     * @return array
     */
    protected function onUpdate()
    {
        $admin = $this->route('admin');
        return [
            'name' => ['required', 'string', 'max:225'],
            'email' => ['required', 'email', 'unique:admins,email,'.$admin->id],
            'password' => $this->password ? ['string', 'min:8'] : '',
            'role' => ['not_in:0'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->isMethod('put') ? $this->onUpdate() : $this->onCreate();
    }

    public function attributes()
    {
        return [
            'name' => 'الإسم',
            'email' => 'البريد الإلكتروني',
            'password' => 'الرقم السري', 
            'role' => 'الدور'
        ];
    }
}
