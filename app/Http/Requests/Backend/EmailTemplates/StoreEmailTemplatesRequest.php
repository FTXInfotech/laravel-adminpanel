<?php

namespace App\Http\Requests\Backend\EmailTemplates;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreEmailTemplatesRequest.
 */
class StoreEmailTemplatesRequest extends FormRequest
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
            'title' => 'required|max:191|unique:email_templates,title',
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
            'title.required'    => 'Email template title must required',
            'title.max'         => 'Email template title may not be greater than 191 characters.',
            'title.unique'      => trans('exceptions.backend.access.email-templates.already_exists')
        ];
    }
}
