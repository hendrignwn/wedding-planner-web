<?php

namespace App\Helpers;

class FirebaseNotification
{
    protected $legacyServerKey = 'AIzaSyA7VLqo8wQW4YbbWq1O3bVk4kRhzmj07Kw';
    
    /**
     * sending push message to single user by firebase reg id
     * 
     * @param type $to
     * @param type $data | [title, is_background, messsage, image, payload, timestamp]
     * @param type $notifications | [title, body]
     * @param type $priority high|normal
     * @return type
     */
    public function sendNewMessage($to, $data, $notifications = [], $priority = 'high') {
        $fields = [
            'to' => $to,
            'data' => $data,
            'click_action' => $notifications['click_action'],
            'priority' => $priority,
            'notification' => $notifications
        ];

        return $this->push($fields);
    }

    // function makes curl request to firebase servers
    private function push($fields) {

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . $this->legacyServerKey,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }

}