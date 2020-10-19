<?php

namespace App\Http\Requests\Backend\BlogTags;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreBlogTagsRequest.
 */
class StoreBlogTagsRequest extends FormRequest
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
            'name' => ['required', 'max:191'],
            'status' => ['boolean'],
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
            'name.required' => 'Blog tag name must required',
            'name.max' => 'Blog tag may not be greater than 191 characters.',
        ];
    }

    /**
     * Body Parameters : Used by scribe to generate doc.
     *
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'Name of the tag.',
                'example' => 'Software',
            ],
            'status' => [
                'description' => 'Status of the tag.',
                'example' => 1,
            ],
        ];
    }
}
