<?php

namespace App\Http\Requests\Backend\Notification;

use App\Http\Requests\Request;

/**
 * Class MarkNotificationRequest.
 */
class MarkNotificationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return '';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}
