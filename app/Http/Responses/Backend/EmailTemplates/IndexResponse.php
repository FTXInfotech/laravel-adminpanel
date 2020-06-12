<?php

namespace App\Http\Responses\Backend\EmailTemplates;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{

    protected $emailTemplates;

    public function __construct($emailTemplates)
    {
        $this->emailTemplates = $emailTemplates;
    }

    public function toResponse($request)
    {
        return view('backend.email-templates.index')->with([
            'emailTemplates' => $this->emailTemplates
        ]);
    }
}
