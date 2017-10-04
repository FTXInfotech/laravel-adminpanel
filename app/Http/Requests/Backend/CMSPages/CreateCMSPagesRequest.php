<?php

namespace App\Http\Requests\Backend\CMSPages;

use App\Http\Requests\Request;

/**
 * Class CreateCMSPagesRequest
 */
class CreateCMSPagesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-cms-pages');
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
