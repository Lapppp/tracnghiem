<?php

namespace App\Http\Requests\Backend\Subject;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreSubjectRequest extends FormRequest
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
            'title' => 'bail|required|unique:subjects,title' . $id . '|max:255'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tên topic',
            'title.max' => 'Tên tên topic chỉ 255 ký tự',
            'title.unique' => 'Tên tên topic đã tồn tại. Vui lòng chọn tên khác.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
