<?php

namespace App\Http\Requests\Backend\BlogTags;

use App\Http\Requests\Request;

/**
 * Class DeleteBlogTagsRequest.
 */
class DeleteBlogTagsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-blog-tag');
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
