<?php

namespace App\Http\Requests\Backend\Comment;

use App\Helpers\PhoneHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreCommentRequest extends FormRequest
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
            'product_id'=>'bail|required',
            'name'=>'bail|required',
//            'email'=>'bail|required|email|max:50',
//            'phone'=>'bail|required',
//            'message'=>'bail|required'
        ];
    }

    public function messages() {
        return [
            'product_id.required' => 'Vui chọn liên kết bài viết',
            'name.required' => 'Vui lòng nhập họ tên',
//            'email.required' => 'Vui lòng nhập địa chỉ email',
//            'email.email' => 'Địa chỉ email không hợp lệ',
//            'email.max' => 'Địa chỉ email không quá 50 ký tự',
//            'phone.required' => 'Vui lòng nhập số điện thoại',
//            'message.required' => 'Vui lòng nhập nội dung',
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
//        $validator->after(function ($validator) {
//            $phone = $this->request->get( 'phone' );
//            if (!PhoneHelper::detect_phone($phone)) {
//                $validator->errors()->add('phone', 'Số điện thoại không hợp lệ. Số điện thoại phải đúng 10 ký tự số.');
//            }
//        });
    }

}
