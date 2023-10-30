<?php

namespace App\Http\Requests\Backend\User;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsersImportRequest extends FormRequest
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
            'file' => 'required|mimes:xls,xlsx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Vui lòng chọn file Excel từ máy tính',
            'file.mimes' => 'Chỉ chấp nhận file xls,xlsx',
            'file.max' => 'Chỉ chấp nhận file có dung lượng 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        /*
         * for ajax, api
         */
        throw new HttpResponseException(
            ResponseHelper::error($validator->errors()->first(), [], 422),
            422
        );
        /*
         * for web
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
        */
    }
    public function withValidator(Validator $validator){
        $category_id = request()->category_id;
        //$id = $this->request->get('category_id');
        //$id = $this->category_id;
        //https://stackoverflow.com/questions/71288559/laravel-form-request-validation-add-errors-to-the-messagebag-without-using-the-a
        if (empty($category_id)){
            $validator->errors()->add('category_id', 'Something is wrong with this field!');
        }

    }
}
