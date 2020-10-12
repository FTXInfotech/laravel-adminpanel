<?php

namespace App\Http\Responses\Backend\EmailTemplates;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $emailTemplate;

    public function __construct($emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
    }

    public function toResponse($request)
    {
        return view('backend.email-templates.edit')->with([
            'emailTemplate' => $this->emailTemplate,
        ]);
    }
}
