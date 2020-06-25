<?php

namespace App\Http\Requests\Backend\BlogCategories;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DeleteBlogCategoriesRequest.
 */
class DeleteBlogCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-blog-category');
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
