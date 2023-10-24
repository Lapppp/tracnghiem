<?php

namespace App\Http\Requests\Frontend\Contact;

use App\Helpers\PhoneHelper;
use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ReceiveContactRequest extends FormRequest
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
            'email' => 'required|email'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập địa chỉ email của bạn.',
            'email.email' => 'Địa chỉ email không hợp lệ'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ResponseHelper::error($validator->errors()->first(), [], 422),
            422
        );
    }
}
