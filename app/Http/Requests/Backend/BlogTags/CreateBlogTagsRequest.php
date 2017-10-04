<?php

namespace App\Http\Requests\Backend\BlogTags;

use App\Http\Requests\Request;

/**
 * Class CreateBlogTagsRequest.
 */
class CreateBlogTagsRequest extends Request
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
            //
        ];
    }
}
