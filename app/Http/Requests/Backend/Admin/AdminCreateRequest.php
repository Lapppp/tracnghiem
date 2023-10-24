<?php

namespace App\Http\Requests\Backend\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AdminCreateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id ? ',' . $this->id : null;
        $rules = [
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|email|unique:admins,email' . $id . '|max:100',
            'gender' => 'bail|required',
            'birthday' => 'bail|required|date_format:d-m-Y',
        ];
        $rules['password'] = 'bail|required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';
        if (request()->isMethod('put')) {
            if(empty($this->password)){
               unset($rules['password']);
            }
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không quá 255 ký tự',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.max' => 'Địa chỉ email không quá 100 ký tự',
            'email.unique' => 'Địa chỉ email này đã tồn tại. Vui lòng chọn email khác',
            'gender.required' => 'Vui chọn giới tính',
            'birthday.required' => 'Vui lòng nhập ngày sinh',
            'birthday.date_format' => 'Vui lòng nhập theo định dạng d-m-Y',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu tối thiểu 6 chữ số',
            'password.max' => 'Mật khẩu không quá 20 ký tự',
            'password.regex' => 'Mật khẩu của bạn ít nhất 6 ký tự, phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số và 1 ký tự đặc biệt',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
