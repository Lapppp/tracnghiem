<?php

namespace App\Http\Requests\Backend\Brand;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreBrandRequest extends FormRequest
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
        return [
            'name' => 'bail|required|unique:region,name' . $id . '|max:255',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên thương hiệu',
            'name.max' => 'Tên tên thương hiệu chỉ 255 ký tự',
            'name.unique' => 'Tên tên thương hiệu đã tồn tại. Vui lòng chọn tên khác.',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
