<?php

namespace App\Http\Utilities;

/*
 * notification.php
 *
 * Copyright 2013 cygnet <cygnet@CIPL-8PC78>
 *
 * Notification class is a abstract class for send push notification in Android and iPhone mobile
 *
 * Author  Viral Solani
 *
 * Version 1.0
 *
 * Created on 17-07-2013
 */
abstract class Notification
{
    protected $_message = null;
    protected $_devices = null;
    protected $_response = null;
    protected $_body = null;
    protected static $_url = null;

    /*
    * Constructer
    *
    * @param string|array $apiKey Device apiKey
    * @param array $options if other condition or data needed than option parameter is usefull
    * @return void
    *
    */

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /*
    * Get authentication headers for sending notifications
    *
    * @return void
    *
    */
    protected function _getAuthHeaders()
    {
    }

    /*
    * _Send Message to devices (it is a abstract function so developer can define in function)
    *
    * @param string|array $deviceId Device Ids
    * @param string $message Message to send
    * @param array $sendOptions Send Options
    * @return boolean
    *
    */

    abstract protected function _send($deviceId, $message, $sendOptions = []);

    /*
    * Send Message to devices (if user not create any function in any particuler class that time this function call)
    *
    * @param string|array $deviceId Device Ids
    * @param string $message Message to send
    * @param array $sendOptions Send Options
    * @return boolean
    *
    *
    */
    public function send($deviceIds, $message, $sendOptions)
    {
        return $this->_send($deviceIds, $message, $sendOptions);
    }

    /*
    * _prepareBody is a function for set body of push notification
    *
    * @param string|array $deviceId Device Ids
    * @param string $message Message to send
    *
    * @return boolean
        *
    */

    protected function _prepareBody($message, $deviceIds)
    {
    }

    public function getResponse()
    {
        return $this->_response;
    }

    /*
    * setOptions is a function for set option for more define variable
    *
    * @param array $options if other condition or data needed than option parameter is usefull
    *
    */
    public function setOptions(array $options)
    {
        foreach ($options as $optionKey => $option) {
            $methodName = 'set'.ucfirst($optionKey);
            $propertyName = '_'.$optionKey;
            if (method_exists($methodName, $this)) {
                $this->$methodName($option);
            } elseif (property_exists($propertyName, $this)) {
                $this->{$propertyName} = $option;
            }
        }
    }

    /*
    * raiseerror is a function for error define
    *
    * @param string $errorCode is a value of constant variable for error
    *
    * by using that function we cane define perticular error message
        *
    * @return boolean
    *
    */

    public function raiseerror($errorCode)
    {
        $codeValue = $this->getErrorMessages();
        if (!isset($codeValue[$errorCode])) {
            $errorException = 'Erro code '.$errorCode;
        } else {
            $errorException = $codeValue[$errorCode];
        }

        //throw new Exception($errorException);
    }

    /*
    * Define Error Messages array
    *
    * @return array
    */

    public function getErrorMessages()
    {
        [];
    }
}
