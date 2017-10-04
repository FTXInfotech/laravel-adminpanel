<?php

namespace App\Http\Requests\Backend\EmailTemplates;

use App\Http\Requests\Request;

/**
 * Class DeleteEmailTemplatesRequest.
 */
class DeleteEmailTemplatesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
