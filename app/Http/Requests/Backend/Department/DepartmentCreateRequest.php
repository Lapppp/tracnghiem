<?php

namespace App\Http\Requests\Backend\Department;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class DepartmentCreateRequest extends FormRequest
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
            'name' => 'bail|required|unique:departments,name' . $id . '|max:255',
            'code' => 'bail|nullable|unique:departments,code' . $id . '|max:255',
            'manager' => 'bail|required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên phòng ban',
            'name.max' => 'Tên phòng ban chỉ 255 ký tự',
            'name.unique' => 'Tên phòng ban đã tồn tại. Vui lòng chọn tên khác.',
            'code.unique' => 'Mã phòng ban đã tồn tại. Vui lòng chọn mã khác.',
            'code.max' => 'Mã phòng ban chỉ 255 ký tự',
            'manager.required' => 'Vui lòng chọn trưởng phòng của phòng ban',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
