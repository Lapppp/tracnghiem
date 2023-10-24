<?php

namespace App\Http\Requests\Backend\Order;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateOrderRequest extends FormRequest
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
            'id' => 'bail|required'
        ];
    }

    public function messages(){
        return [
            'id.required' => 'Vui lòng nhập mã hóa đơn',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
