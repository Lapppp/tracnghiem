<?php

namespace App\Http\Requests\Frontend\User;

use App\Helpers\PhoneHelper;
use App\Models\Users\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;

class StoreUserForgotPasswordRequest extends FormRequest
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
        $rules = [
            'email' => 'bail|required|email'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email không hợp lệ'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $email = $this->request->get('email');
            $user = User::where('email', $email)->first();
            if ( !$user ) {
                $validator->errors()->add('email', 'Địa chỉ email này không tồn tại. Vui lòng chọn một email khác');
            }
        });
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ResponseHelper::error($validator->errors()->first(), [], 422),
            422
        );

//        throw ( new ValidationException($validator) )
//            ->errorBag($this->errorBag)
//            ->redirectTo($this->getRedirectUrl());
    }
}
