<?php

namespace App;

use App\Mail\ForgotPasswordNotification;
use App\Mail\RegisterNotification;
use App\Mail\RegisterRequestNotification;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Mail;

class User extends Authenticatable
{
    use Notifiable;
    
    private $_path;
    
    const UPLOAD_DESTINATION_PATH = 'files/users/';

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_NEED_REGISTER = 5;
    
    const ROLE_SUPERADMIN = 1;
    const ROLE_USER = 10;
    
    const GENDER_MALE = '1';
    const GENDER_FEMALE = '0';
    
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'gender', 
        'gender_label', 
        'email', 
        'phone', 
        'password',
        'firebase_token',
        'user_id_token',
        'registered_token',
        'registered_device_number',
        'registered_at',
        'token',
        'status',
        'role',
        'device_number',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
        $path = public_path(self::UPLOAD_DESTINATION_PATH);

        if(!is_dir($path)) {
            \File::makeDirectory($path, 0755);
        }
        $this->setPath($path);
    }
    
    public function userRelation()
    {
        if ($this->getIsGenderMale()) {
            return $this->maleUserRelation();
        }
        return $this->femaleUserRelation();
    }
    
    public function maleUserRelation()
    {
        return $this->hasOne('\App\UserRelation', 'male_user_id', 'id');
    }
    
    public function femaleUserRelation()
    {
        return $this->hasOne('\App\UserRelation', 'female_user_id', 'id');
    }
    
    /**
     * @param type $prefix
     * @param type $ext
     * @return type
     */
    public function generateFilename($prefix, $ext)
    {
        return str_slug($prefix . ' ' . $this->code . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
    public function generateActivationCode()
    {
        return random_int(1000, 9999);
    }
    
    /**
	 * @param type $query
	 * @return query
	 */
	public function scopeActived($query)
	{
		return $query->where($this->table . '.status', self::STATUS_ACTIVE);
	}
    
    public function scopeRoleMobileApp($query)
    {
        return $query->whereIn($this->table . '.role', [
            self::ROLE_USER,
        ]);
    }
    
    public function scopeRoleAdministrator($query)
    {
        return $query->whereIn($this->table . '.role', [
            self::ROLE_SUPERADMIN,
        ]);
    }

	/**
	 * set path
	 * 
	 * @param string $value
	 */
	public function setPath($value)
	{
		$this->_path = $value;
	}
	
	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->_path;
	}    
    
    /**
	 * @return array
	 */
    public static function statusLabels()
	{
		return [
			self::STATUS_ACTIVE => 'Active',
			self::STATUS_NEED_REGISTER => 'Need Registered',
			self::STATUS_INACTIVE => 'Inactive',
		];
	}
    
    /**
	 * @return array
	 */
    public static function genderLabels()
	{
		return [
			self::GENDER_MALE => 'Male',
			self::GENDER_FEMALE => 'Female',
		];
	}
	
	/**
	 * @return string
	 */
	public function getStatusLabel()
	{
		$list = self::statusLabels();
		
		return $list[$this->status] ? $list[$this->status] : $this->status;
	}
	
	/**
	 * @return string
	 */
	public function getGenderLabel()
	{
		$list = self::genderLabels();
		
		return $list[$this->gender] ? $list[$this->gender] : $this->gender;
	}
    
    /**
	 * @return array
	 */
    public static function roleAdminLabels()
	{
		return [
			self::ROLE_SUPERADMIN => 'Super Admin',
		];
	}
	
	/**
	 * @return string
	 */
	public function getRoleAdminLabel()
	{
		$list = self::roleAdminLabels();
		
		return $list[$this->role] ? $list[$this->role] : $this->role;
	}
    
    /**
	 * @return array
	 */
    public static function roleMobileAppLabels()
	{
		return [
			self::ROLE_USER => 'User',
		];
	}
	
	/**
	 * @return string
	 */
	public function getRoleMobileAppLabel()
	{
		$list = self::roleMobileAppLabels();
		
		return $list[$this->role] ? $list[$this->role] : $this->role;
	}
    
    public function getIsGenderMale()
    {
        return $this->gender == self::GENDER_MALE;
    }
    
    public function insertFirstContentData()
    {
        $concepts = Concept::defaultContentData();
    
        $available = Content::whereUserRelationId($this->userRelation->id)->count();
        if ($available > 0) {
            return true;
        }
        DB::beginTransaction();
        foreach ($concepts as $key => $item) {

            $content = new Content();
            $content->user_relation_id = $this->userRelation->id;
            $content->user_id = $this->id;
            $content->fill($item['content']);
            $content->save();
            foreach ($item['content_details'] as $detail) {
                $contentDetail = new ContentDetail();
                $contentDetail->fill($detail);
                $contentDetail->content_id = $content->id;
                $contentDetail->save();
            }
        }
        DB::commit();
        
        return true;
    }
    
    /**
     * @return boolean
     */
    public function sendNeedRegisterNotification()
    {
        if ($this->gender == self::GENDER_MALE) {
            $relation = $this->userRelation->femaleUser;
        } else {
            $relation = $this->userRelation->maleUser;
        }
        
        Mail::to([$this->email])
                    ->queue(new RegisterRequestNotification($this, $relation));
        
        return true;
    }
    
    /**
     * @return boolean
     */
    public function sendRegisterNotification()
    {
        Mail::to([$this->email], $this->name)
                    ->queue(new RegisterNotification($this));
        
        return true;
    }
    
    /**
     * @return boolean
     */
    public function sendForgotPasswordNotification()
    {
        Mail::to([$this->email], $this->name)
                    ->queue(new ForgotPasswordNotification($this));
        
        return true;
    }
    
    public function getUrlRegisteredRequest()
    {
        return url('register-relation', ['token' => $this->registered_token]);
    }
    
    public function getUrlForgotPassword()
    {
        return url('reset-your-password', ['token' => $this->forgot_token]);
    }
}
