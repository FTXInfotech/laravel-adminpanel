<?php

namespace App\Http\Requests\Backend\EmailTemplates;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateEmailTemplatesRequest.
 */
class CreateEmailTemplatesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-email-template');
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
