<?php

namespace App\Exceptions;

use Exception;

/**
 * Class GeneralException.
 */
class GeneralException extends Exception
{
    /**
     * message.
     *
     * @var string
     */
    public $message;

    /**
     * dontHide.
     *
     * @var bool
     */
    public $dontHide;

    /**
     * Constructor function.
     *
     * @param string $message
     * @param bool   $dontHide
     */
    public function __construct($message, $dontHide = false)
    {
        $this->message = $message;
        $this->dontHide = $dontHide;
    }
}
