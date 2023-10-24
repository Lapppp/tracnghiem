<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;

class UpdateUserRequest extends FormRequest
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
        $user = Auth::guard('web')->user();
        $id = $user->id ? ',' . $user->id : null;
        $rules = [
            'name' => 'bail|required|max:255',
            'phone' => 'required|unique:users,phone' . $id . '|digits:10',
            'email' => 'bail|required|email|unique:users,email' . $id . '|max:100',
            'voteImage.*' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        ];
        return $rules;
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
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits' => 'Số điện thoại phải là dạng 10 chữ số',
            'phone.unique' => 'Số điện thoại đã có người dùng. Vui lòng chọn số khác',
            'voteImage.*.max' => 'Tập tin hình ảnh nhỏ hơn 2MB',
            'voteImage.*.mimes' => 'Chỉ tải lên những tập tin có dạng jpeg, jpg, gif, svg, png.',
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
