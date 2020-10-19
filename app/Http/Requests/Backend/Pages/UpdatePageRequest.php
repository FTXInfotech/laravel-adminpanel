<?php

namespace App\Http\Requests\Backend\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-page');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:191', 'unique:pages,title,'.optional($this->route('page'))->id],
            'description' => ['required', 'string'],
            'status' => ['boolean'],
            'cannonical_link' => ['string', 'nullable', 'url'],
            'seo_title' => ['string', 'nullable'],
            'seo_keyword' => ['string', 'nullable'],
            'seo_description' => ['string', 'nullable'],
        ];
    }
}
