<?php

namespace App\Http\Requests\Frontend\Products;

use App\Helpers\PhoneHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreProductRequest extends FormRequest
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
            'email'=>'bail|required|email|max:50',
            'phone'=>'bail|required',
            'message'=>'bail|required',
            'voteImage.*' => 'bail|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'voteImage' => 'bail|max:5',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.max' => 'Địa chỉ email không quá 50 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'voteImage.*.max' => 'Tập tin hình ảnh nhỏ hơn 2MB',
            'voteImage.*.mimes' => 'Chỉ tải lên những tập tin có dạng jpeg, jpg, gif, svg, png.',
            'voteImage.max' => 'Chỉ upload tối đa là 5 hình ảnh'
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
