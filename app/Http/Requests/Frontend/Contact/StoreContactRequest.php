<?php

namespace App\Http\Requests\Frontend\Contact;

use App\Helpers\PhoneHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreContactRequest extends FormRequest
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
        return [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|digits:10',
            'email' => 'nullable|email',
            'message' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'firstname.required' => 'Vui lòng nhập tên của bạn.',
            'firstname.max' => 'Tên không quá 255 ký tự',
            'lastname.required' => 'Vui lòng nhập họ và chữ lót.',
            'lastname.max' => 'họ và chữ lót không quá 255 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits' => 'Số điện thoại phải là dạng 10 chữ số',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'message.required' => 'Vui lòng nhập nội dung',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $phone = $this->request->get( 'phone' );
            if (!PhoneHelper::detect_phone($phone)) {
                $validator->errors()->add('phone', 'Số điện thoại không hợp lệ. Số điện thoại phải đúng 10 ký tự số.');
            }
        });
    }
}
