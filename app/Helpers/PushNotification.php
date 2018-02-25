<?php

namespace App\Helpers;

/**
 * @author Hendri Gunawan <hendri.gnw@gmail.com>
 */
class PushNotification {
	
	private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
 
    function __construct() {
         
    }
 
    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }
 
    public function getPushNotification() {
        $result = [];
        $result['title'] = $this->title;
        $result['is_background'] = $this->is_background;
        $result['message'] = $this->message;
        $result['image'] = $this->image;
        $result['payload'] = $this->data;
        $result['timestamp'] = date('Y-m-d G:i:s');
		$result['vibrate'] = 1;
		$result['sound'] = 1;
        return $result;
    }
}