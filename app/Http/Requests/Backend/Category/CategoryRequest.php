<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'slug' => 'bail|required|regex:/^\S*$/u|unique:categories,slug' . $id . '|max:5000',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'slug.required' => 'Vui lòng nhập tên slug',
            'slug.unique' => 'Tên slug đã tồn tại, vui lòng chọn tên slug khác',
            'slug.regex' => 'Tên slug không có các khoảng trắng',
        ];
    }
}
