<?php

namespace App\Http\Requests\Backend\BlogTags;

use App\Http\Requests\Request;

/**
 * Class StoreBlogTagsRequest.
 */
class StoreBlogTagsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-blog-tag');
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
            'name.required' => 'Blog Tag name is a required field.',
            'name.max'      => 'Blog Tag may not be greater than 191 characters.',
        ];
    }
}
