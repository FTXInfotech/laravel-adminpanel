<?php

namespace App\Events\Backend\Faqs;

use Illuminate\Queue\SerializesModels;

/**
 * Class FaqCreated.
 */
class FaqCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $faq;

    /**
     * @param $page
     */
    public function __construct($faq)
    {
        $this->faq = $faq;
    }
}
