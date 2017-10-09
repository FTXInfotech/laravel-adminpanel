<?php

namespace App\Http\Requests\Backend\BlogCategories;

use App\Http\Requests\Request;

/**
 * Class StoreBlogCategoriesRequest.
 */
class StoreBlogCategoriesRequest extends Request
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
            'name' => 'required|max:191',
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
            'name.max'      => 'Blog category may not be greater than 191 characters.',
        ];
    }
}
