<?php

namespace App\Http\Requests\Backend\Question;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreQuestionRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'answer' => 'bail|required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên video',
            'name.max' => 'Tên tên video chỉ 255 ký tự',
            'answer.required' => 'Vui lòng nhập nội dung câu hỏi',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
