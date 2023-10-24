<?php

namespace App\Http\Requests\Backend\Company;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreCompanyRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'certificate' => 'bail|required',
            'granted_by' => 'bail|required',
            'address' => 'bail|required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên công ty',
            'name.max' => 'Tên tên công ty chỉ 255 ký tự',
            'name.certificate' => 'Vui lòng nhập Giấy CNĐKDN',
            'name.granted_by' => 'Vui lòng nhập Cấp bởi',
            'name.address' => 'Vui lòng nhập Địa chỉ đăng ký kinh doanh',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
