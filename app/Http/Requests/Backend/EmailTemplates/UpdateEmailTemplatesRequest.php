<?php

namespace App\Http\Requests\Backend\EmailTemplates;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateEmailTemplatesRequest.
 */
class UpdateEmailTemplatesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-email-template');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:191|unique:email_templates,title,'.$this->segment(3),
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
            'title.unique' => __('exceptions.backend.email-templates.already_exists'),
            'title.required' => 'Email Template title must required',
            'title.max' => 'Email template title may not be greater than 191 characters.',
        ];
    }
}
