<?php

namespace App\Http\Requests\Backend\EmailTemplates;

use App\Http\Requests\Request;

/**
 * Class UpdateEmailTemplatesRequest.
 */
class UpdateEmailTemplatesRequest extends Request
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
            'title'   => 'required|max:191',
            'type_id' => 'required',
            'subject' => 'required|max:191',
            'body'    => 'required',
        ];
    }
}
