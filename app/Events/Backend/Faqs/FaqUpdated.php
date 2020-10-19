<?php

namespace App\Events\Backend\Faqs;

use Illuminate\Queue\SerializesModels;

/**
 * Class FaqUpdated.
 */
class FaqUpdated
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
