<?php

namespace App\Http\Utilities;

/**
 * Created By : Umang Soni
 * Created at : 26/05/2017
 * Push Notification Class.
 */
class PushNotification
{
    /**
     * PushNotification.
     *
     * @param array  $msg
     * @param string $type
     * @param array  $devicetoken
     * @param array  $params
     * @param string $user_id
     *
     * @return bool
     */
    public function _pushNotification($msg, $type, $devicetoken)
    {
        if ($devicetoken) {
            switch ($type) {
                case 'ios':
                    return $this->_pushToIos($devicetoken, $msg);

                    return true;
                    break;

                case 'android':
                    return $this->_pushToAndroid($devicetoken, $msg);
                    break;

                default:
                    echo 'Invalid Type Passed';
            }

            return false;
        } else {
            $status = 500;
            $response['status'] = false;
            $response['message'] = 'No device found';

            return false;
        }
    }

    /**
     * PushNotification for android.
     *
     * @param array $devicetoken
     * @param array $msg
     * @param array $params
     *
     * @return bool
     */
    public function _pushToAndroid($registrationIds, $msg)
    {
        if (!is_array($registrationIds)) {
            $registrationIds = [$registrationIds];
        }
        $fields = [
            'registration_ids' => $registrationIds,
            'data'             => $msg,
        ];

        $headers = [
            'Authorization: key='.config('access.AccessKey'),
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    /**
     * PushNotification for IOS.
     *
     * @param array  $devicetoken
     * @param array  $msg
     * @param array  $params
     * @param string $user_id
     *
     * @return bool
     */
    public function _pushtoios($devicetoken, $message)
    {
        $passphrase = 'apple'; //pwd: Infowelt@123
        $ctx = stream_context_create();
        //stream_context_set_option($ctx, 'ssl', 'local_cert', TMP . 'pem/apns_baseproject_dev.pem');
        stream_context_set_option($ctx, 'ssl', 'local_cert', public_path().'/pem/Push_Infowelt.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        //$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            exit("Failed to connect amarnew: $err $errstr".PHP_EOL);
        }

        $body['aps'] = [
            'badge' => +1,
            'alert' => $message,
            'sound' => 'default',
        ];
        $payload = json_encode($body);
        $msg = chr(0).pack('n', 32).pack('H*', $devicetoken).pack('n', strlen($payload)).$payload;

        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result) {
            return false;
        } else {
            return true;
        }
        fclose($fp);
    }
}
