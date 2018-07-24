<?php

namespace App\Http\Requests\Backend\Menu;

use App\Http\Requests\Request;

/**
 * Class StoreMenuRequest.
 */
class StoreMenuRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-menu');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required',
        ];
    }
}
