<?php

namespace App\Http\Requests\API\Users;

use Illuminate\Contracts\Validation\Validator;
use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DemoUserRequest extends FormRequest
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
            '*.question_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            '*.question_id.required' => 'Question ID is required',
        ];
    }

    protected function failedValidation($validator)
    {
        throw new HttpResponseException(
            ResponseHelper::error($validator->errors()->first(), [], 422),
            422
        );
    }
}
