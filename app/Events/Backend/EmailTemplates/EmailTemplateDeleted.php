<?php

namespace App\Events\Backend\EmailTemplates;

use Illuminate\Queue\SerializesModels;

/**
 * Class EmailTemplateDeleted.
 */
class EmailTemplateDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $emailTemplate;

    /**
     * @param $emailTemplate
     */
    public function __construct($emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
    }
}
