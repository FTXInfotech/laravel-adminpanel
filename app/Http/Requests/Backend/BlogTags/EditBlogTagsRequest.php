<?php

namespace App\Http\Requests\Backend\BlogTags;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditBlogTagsRequest.
 */
class EditBlogTagsRequest extends FormRequest
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
            //
        ];
    }
}
