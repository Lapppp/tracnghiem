<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;

class UpdateChangeUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = Auth::guard('web')->user();
        if($id){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = Auth::guard('web')->user();
        $id = $user->id ? ',' . $user->id : null;
        return [
            //'username' => 'bail|required|unique:users,username|max:100',
            'name' => 'bail|required|max:255',
            //'phone' => 'required|unique:users,phone' . $id . '|digits:10',
            'email' => 'bail|required|email|unique:users,email' . $id . '|max:100',
            //'phone' => 'required|unique:users,phone|digits:10',
            //'email' => 'bail|required|email|unique:users,email|max:100',
            'password' => 'bail|nullable|string|min:6|max:20',
            //'password' => 'bail|required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'nullable|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không quá 255 ký tự',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.max' => 'Địa chỉ email không quá 100 ký tự',
            'email.unique' => 'Địa chỉ email này đã tồn tại. Vui lòng chọn email khác',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu tối thiểu 6 chữ số',
            'password.max' => 'Mật khẩu không quá 20 ký tự',
            'password.regex' => 'Mật khẩu của bạn ít nhất 6 ký tự, phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số và 1 ký tự đặc biệt',
            'password_confirmation.same' => 'Không cùng mật khẩu với nhập mật khẩu',
           // 'phone.required' => 'Vui lòng nhập số điện thoại',
           // 'phone.digits' => 'Số điện thoại phải là dạng 10 chữ số',
          //  'phone.unique' => 'Số điện thoại đã có người dùng. Vui lòng chọn số khác',
           // 'username.required' => 'Vui lòng nhập tên đăng nhập.',
           // 'username.unique' => 'Tên này đã có người dùng rồi. Vui lòng chọn tên khác',
        ];
    }

    protected function failedValidation( Validator $validator )
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
