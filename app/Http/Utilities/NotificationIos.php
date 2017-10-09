<?php

namespace App\Http\Utilities;

class NotificationIos extends Notification
{
    const BADGE_ID = 0;

    protected $_passPhrase = null;            // for authentication of .pem file or password of .pem file
    protected $_pemFile = null;            // for send notificetion .pem file is must add in that code
    protected static $_url = 'ssl://gateway.sandbox.push.apple.com:2195';                                           // url for send push message

    const ERROR_PEM_NOTACCESSIBLE = 1;          // exception error for file not get
    const ERROR_PASSPHRASE_EMPTY = 2;          // exception error for passphrese empty
    const ERROR_CONNECTION_FAILED = 3;          // exception error for connection failed

    protected $sendNotification = 1;          // exception error for connection failed

    /**
     * send push notification.
     */
    public function pushNotification($msg, $deviceToken, $sendData)
    {
        $obj = new self();
        $obj->setPassPhrase('Infowelt@123');
        $obj->setPemFile();
        $deviceId = $deviceToken;
        $message = $msg;
        $sendOptions = $sendData;
        echo $obj->send($deviceId, $message, $sendOptions);
    }

    /*
     * Send Message to devices
     *
     * @param string|array $deviceId Device Ids
     * @param string|array $message Message to send
     * @param array $sendOptions Send Options
     * @return boolean
     */

    protected function _send($deviceId, $message, $sendOptions = [])
    {
        if (is_null($this->_passPhrase)) {
            $this->raiseerror(self::ERROR_PASSPHRASE_EMPTY);
        }
        dd($this->_pemFile);
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $this->_pemFile);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $this->_passPhrase);
        $fp = stream_socket_client(self::$_url, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

        if (!$fp) {
            $this->raiseerror(self::ERROR_CONNECTION_FAILED);
        }
        //return 'Connected to APNS' . PHP_EOL;
        // Create the payload body
        $body['aps'] = $this->_prepareBody($message, $sendOptions);
        // Encode the payload as JSON
        $payload = json_encode($body);
        //echo '<pre>';
        //print_r($deviceId); exit;

        foreach ($deviceId as $singleId) {
            // Build the binary notification
            $msg = chr(0).pack('n', 32).pack('H*', $singleId).pack('n', strlen($payload)).$payload;
            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));
        }
        //echo "<br>-------<br>";
        if (!$result) {
            return 'Message not delivered'.PHP_EOL;
        } else {
            return 'Message successfully delivered'.PHP_EOL;
        }

        // Close the connection to the server
        fclose($fp);
    }

    protected function _prepareBody($message, $sendOptions)
    {
        if ($this->sendNotification == 1) {
            return ['alert' => $message, 'sound' => 'default', 'badge' => self::BADGE_ID];
        } else {
            return ['badge' => 0];
        }
    }

    public function sendNotification($sendNotification)
    {
        $this->sendNotification = $sendNotification;
    }

    public function setPassPhrase($passPhrase)
    {
        $this->_passPhrase = $passPhrase;
    }

    public function setPemFile($pemFile = 'apns_baseproject_dev.pem')
    {
        $newPemFilePath = dirname(__FILE__).'/'.$pemFile;
        // echo $_SERVER['DOCUMENT_ROOT'].'/app/Http/Controllers/Utilities/'.$pemFile;exit;
        //echo dirname(__FILE__); exit;
        // echo file_get_contents(dirname(__FILE__).'/'.$pemFile); exit;
        if (!(file_exists($newPemFilePath)) && !(is_readable($newPemFilePath))) {
            $error = $this->raiseerror(self::ERROR_PEM_NOTACCESSIBLE);
        }
        $this->_pemFile = $newPemFilePath;
    }

    public function getErrorMessages()
    {
        return [
            self::ERROR_PEM_NOTACCESSIBLE => 'Pem File Not Found',
            self::ERROR_PASSPHRASE_EMPTY  => 'Pass Phrase empty',
            self::ERROR_CONNECTION_FAILED => 'Connect Failed',
        ];
    }
}
