<?php

namespace App\Http\Requests\Backend\Blogs;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateBlogsRequest.
 */
class CreateBlogsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//access()->allow('create-blog');
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
