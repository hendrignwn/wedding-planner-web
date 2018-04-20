<?php

namespace App;

use App\Helpers\FirebaseNotification;
use Carbon\Carbon;

class Message extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/messages/';
    const UPLOAD_DESTINATION_PATH_THUMB = 'files/messages/thumbs/';
    
    private $_thumbPath;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'message';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'file',
        'start_date',
        'end_date',
        'is_all_date',
        'message_at',
        'sent_notification',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
        $path = public_path(self::UPLOAD_DESTINATION_PATH);
        $pathThumb = public_path(self::UPLOAD_DESTINATION_PATH_THUMB);

        if(!is_dir($path)) {
            \File::makeDirectory($path, 0755);
        }
        if(!is_dir($pathThumb)) {
            \File::makeDirectory($pathThumb, 0755);
        }
        $this->setPath($path);
        $this->setThumbPath($pathThumb);
    }
    
    public function getFileUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->file);
    }
    
    public function getFileThumbUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH_THUMB . $this->file);
    }
    
    public function getFileThumbImg()
    {
        if ($this->file != null) {
            return "<img src='{$this->getFileThumbUrl()}' width='150' />";
        }
        
        return null;
    }
    
    public function getFileImg()
    {
        if ($this->file != null) {
            return "<img src='{$this->getFileUrl()}' width='100%' />";
        }
        
        return null;
    }
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
	/**
	 * set path
	 * 
	 * @param string $value
	 */
	public function setThumbPath($value)
	{
		$this->_thumbPath = $value;
	}
	
	/**
	 * @return string
	 */
	public function getThumbPath()
	{
		return $this->_thumbPath;
	}
    
    public function deleteFile($file = null)
    {
        if ($file == null) {
            $file = $this->file;
        }
        @unlink($this->getPath() . $file);
    }
    
    public function deleteThumbFile($file = null)
    {
        if ($file == null) {
            $file = $this->file;
        }
        @unlink($this->getThumbPath() . $file);
    }
    
    public function deleteAllFiles()
    {
        $this->deleteFile();
        $this->deleteThumbFile();
        return true;
    }
    
    public static function sendPushNotification()
    {
        $messages = Message::where('message_at', \Carbon\Carbon::now()->toDateString() . ' 00:00:00')
                ->whereIsNull('sent_notification')
                ->get();
        if (!$messages) {
            return null;
        }
        
        $users = User::whereNotNull('firebase_token')->where('status', User::STATUS_ACTIVE)
                ->get();
        if (!$users) {
            return null;
        }
        
        foreach ($messages as $message) :
            $notifications = [
                'title' => $message->name,
                'body' => strip_tags(substr($message->description, 0, 80)),
                'sound' => 'default',
                'badge' => 0,
                'click_action' => 'com.hendri.agendanikah.firebase.message.notification',
            ];
            foreach ($users as $user) {
                $notification = new FirebaseNotification();
                $notification->sendNewMessage($user->firebase_token, $message->toArray(), $notifications);
            }
        endforeach;
    }
}
