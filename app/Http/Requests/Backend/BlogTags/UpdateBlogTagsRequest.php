<?php

namespace App\Http\Requests\Backend\BlogTags;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateBlogTagsRequest.
 */
class UpdateBlogTagsRequest extends FormRequest
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
            'name' => 'required|max:191|unique:blog_tags,name,'.$this->segment(4),
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
            'name.unique'   => trans('exceptions.backend.access.blog-tag.already_exists'),
            'name.required' => 'Blog tag name must required',
            'name.max'      => 'Blog tag may not be greater than 191 characters.',
        ];
    }
}
