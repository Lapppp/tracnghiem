<?php

namespace App\Http\Requests\Backend\Support;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreSupportRequest extends FormRequest
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
            'hotline' => 'bail|required',
            'advise' => 'bail|required',
            'email' => 'bail|required|email',
            'insurance' => 'bail|required',
            'product_consultation' => 'bail|required',
            'technical_assistance' => 'bail|required',
            'free_call_center' => 'bail|required',
            'zalo' => 'bail|required',
        ];
    }

    public function messages(){
        return [
            'hotline.required' => 'Vui lòng nhập hotline',
            'advise.required' => 'Vui lòng nhập Tư vấn',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'insurance.required' => 'Vui lòng nhập Bảo hành',
            'product_consultation.required' => 'Vui lòng nhập Tư vấn sản phẩm',
            'technical_assistance.required' => 'Vui lòng nhập Hỗ trợ kỹ thuật',
            'free_call_center.required' => 'Vui lòng nhập Tổng đài miễn phí',
            'zalo.required' => 'Vui lòng nhập ZALO',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
