<?php

namespace App\Http\Requests\Backend\BlogCategories;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class ManageBlogCategoriesRequest.
 */
class ManageBlogCategoriesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
