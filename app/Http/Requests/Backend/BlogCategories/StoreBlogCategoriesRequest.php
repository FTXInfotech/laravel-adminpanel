<?php

namespace App\Http\Requests\Backend\BlogCategories;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreBlogCategoriesRequest.
 */
class StoreBlogCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-blog-category');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191|unique:blog_categories,name',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Blog category name must required',
            'name.unique'   => 'Blog category name already exist.',
            'name.max'      => 'Blog category may not be greater than 191 characters.',
        ];
    }
}
