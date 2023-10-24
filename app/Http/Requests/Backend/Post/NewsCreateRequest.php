<?php

namespace App\Http\Requests\Backend\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class NewsCreateRequest extends FormRequest
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
        $rules = [
            'name' => 'bail|required|max:255',
            'slug' => 'bail|required|regex:/^\S*$/u|unique:posts,name' . $id . '|max:5000',
        ];
//        if ( request()->hasfile('files') ) {
//
//            $photos = count(request()->file('files'));
//            foreach ( range(0, $photos) as $index ) {
//                $rules['files.' . $index] = 'nullable|image|mimes:jpeg,bmp,png|max:2000';
//            }
//        }

        return $rules;
    }

    public function messages()
    {
        return [
            'slug.unique' => 'SEO tiêu đề đã đặt rồi. Vui lòng đặt SEO tiêu đề khác.',
            'slug.regex' => 'SEO tiêu đề không thể có khoảng trắng.',
            'name.required' => 'Vui lòng nhập tiêu đề.',
        ];
    }

    protected function failedValidation( Validator $validator )
    {
        throw ( new ValidationException($validator) )
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
