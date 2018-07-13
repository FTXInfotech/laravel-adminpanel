<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request.
 */
abstract class Request extends FormRequest
{
    /**
     * @var string
     */
    protected $error = '';

    /**
     * @return $this
     */
    public function forbiddenResponse()
    {
        if (empty($error)) {
            $this->error = trans('auth.general_error');
        }

        return redirect()->back()->withErrors($this->error);
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('This action is unauthorized.');
    }
}
