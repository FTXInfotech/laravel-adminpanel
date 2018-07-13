<?php

namespace App\Http\Requests\Backend\Settings;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class ManageSettingsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-settings');
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
