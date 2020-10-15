<?php

namespace App\Http\Requests\Backend\Blogs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreBlogsRequest.
 */
class StoreBlogsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-blog');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:191', 'unique:blogs,name'],
            'publish_datetime' => ['required', 'date'],
            'content' => ['required', 'string'],
            'categories' => ['required', 'array'],
            'categories.*' => ['string'],
            'tags' => ['required', 'array'],
            'tags.*' => ['string'],
            'status' => ['integer', 'between:0,3'],
            'meta_title' => ['string', 'nullable'],
            'cannonical_link' => ['string', 'nullable', 'url'],
            'meta_keywords' => ['string', 'nullable'],
            'meta_description' => ['string', 'nullable'],
            'featured_image' => ['nullable', 'image'],
        ];
    }

    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please insert Blog Title',
            'name.max' => 'Blog Title may not be greater than 191 characters.',
            'name.unique' => 'The blog name already taken. Please try with different name.',
        ];
    }
}
