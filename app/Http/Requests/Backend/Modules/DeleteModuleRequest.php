<?php

namespace App\Http\Requests\Backend\Modules;

use App\Http\Requests\Request;

/**
 * Class DeleteModuleRequest.
 */
class DeleteModuleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return access()->allow('delete-blog');
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
            //
        ];
    }
}
