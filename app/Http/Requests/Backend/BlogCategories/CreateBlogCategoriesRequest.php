<?php

namespace App\Http\Requests\Backend\BlogCategories;

use App\Http\Requests\Request;

/**
 * Class CreateBlogCategoriesRequest.
 */
class CreateBlogCategoriesRequest extends Request
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
            //
        ];
    }
}
