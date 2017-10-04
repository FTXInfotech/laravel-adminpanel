<?php

namespace App\Http\Requests\Backend\Modules;

use App\Http\Requests\Request;

/**
 * Class CreateModuleRequest.
 */
class CreateModuleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return access()->allow('create-blog');
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
