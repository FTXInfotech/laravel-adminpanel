<?php

namespace App\Events\Backend\Faqs;

use Illuminate\Queue\SerializesModels;

/**
 * Class FaqDeleted.
 */
class FaqDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $faq;

    /**
     * @param $faq
     */
    public function __construct($faq)
    {
        $this->faq = $faq;
    }
}
