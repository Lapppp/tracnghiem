<?php

namespace App\Http\Requests\Backend\Advise;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreAdviseRequest extends FormRequest
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
            'full_name' => 'bail|required|max:255',
            'phone' => 'bail|required'
        ];
    }

    public function messages(){
        return [
            'full_name.required' => 'Vui lòng nhập họ tên',
            'full_name.max' => 'Tên tên đơn vị tính chỉ 255 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
