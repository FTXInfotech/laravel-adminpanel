<?php

namespace App\Http\Requests\Backend\CMSPages;

use App\Http\Requests\Request;

/**
 * Class UpdateCMSPagesRequest.
 */
class UpdateCMSPagesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-cms-pages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|max:191',
            'description' => 'required',
        ];
    }
}
