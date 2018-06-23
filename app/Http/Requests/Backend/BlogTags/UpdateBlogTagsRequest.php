<?php

namespace App\Http\Requests\Backend\BlogTags;

use App\Http\Requests\Request;

/**
 * Class UpdateBlogTagsRequest.
 */
class UpdateBlogTagsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-blog-tag');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191|unique:blog_tags,name,'.$this->segment(3),
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
            'name.unique'   => 'Blog Tag name already exists, please enter a different name.',
            'name.required' => 'Blog Tag name is a required field.',
            'name.max'      => 'Blog Tag may not be greater than 191 characters.',
        ];
    }
}
