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
    public $emailtemplates;

    /**
     * @param $emailtemplates
     */
    public function __construct($emailtemplates)
    {
        $this->emailtemplates = $emailtemplates;
    }
}
