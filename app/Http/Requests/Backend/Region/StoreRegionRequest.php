<?php

namespace App\Http\Requests\Backend\Region;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRegionRequest extends FormRequest
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
            'code' => 'bail|nullable|unique:region,code' . $id . '|max:255',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên vùng,miền',
            'name.max' => 'Tên tên vùng,miền chỉ 255 ký tự',
            'name.unique' => 'Tên tên vùng,miền đã tồn tại. Vui lòng chọn tên khác.',
            'code.unique' => 'Mã tên vùng,miền đã tồn tại. Vui lòng chọn mã khác.',
            'code.max' => 'Mã tên vùng,miền chỉ 255 ký tự',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
