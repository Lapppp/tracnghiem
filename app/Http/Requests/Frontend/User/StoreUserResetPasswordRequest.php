<?php

namespace App\Http\Requests\Frontend\User;

use App\Helpers\PhoneHelper;
use App\Models\Users\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;

class StoreUserResetPasswordRequest extends FormRequest
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
            'password' => 'bail|required',
            'user_id' => 'bail|required',
            'key_id' => 'bail|required'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'user_id.required' => 'Tài khoản không hợp lệ',
            'key_id.required' => 'Tài khoản không hợp lệ mã không hợp lệ'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $id = $this->request->get('user_id');
            $reset_password = $this->request->get('key_id');
            $user = User::find($id);
            if ( !$user ) {
                $validator->errors()->add('user_id', 'Tài khoản không tồn tại trong hệ thống');
            }

            if($reset_password != $user->reset_password) {
                $validator->errors()->add('user_id', 'Tài khoản không trùng khớp dữ liệu');
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
