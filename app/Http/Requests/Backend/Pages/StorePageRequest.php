<?php

namespace App\Http\Requests\Backend\Pages;

use App\Http\Requests\Request;

/**
 * Class StorePageRequest.
 */
class StorePageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-page');
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
