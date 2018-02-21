<?php

namespace App;

class UserRelation extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/user-relations/';

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_relation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'male_user_id',
        'female_user_id',
        'wedding_day',
        'venue',
        'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'male_user_id',
        'female_user_id',
    ];
    
    protected $with = [
        'maleUser',
        'femaleUser'
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
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . \Carbon\Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
    public function maleUser()
    {
        return $this->hasOne('\App\User', 'id', 'male_user_id');
    }
    
    public function femaleUser()
    {
        return $this->hasOne('\App\User', 'id', 'female_user_id');
    }
    
    public function getPhotoUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->photo);
    }
    
    public function getRelationName()
    {
        return $this->femaleUser->name . ' & ' . $this->maleUser->name;
    }
    
    public function getListCosts()
    {
        $models = ContentDetail::whereHas('content', function($query) {
                $query->where('content.user_relation_id', '=', $this->id);
            })
            ->where('content_detail.is_cost', '=', 1)
            ->orderBy('content_detail.order', 'asc')
            ->get();
            
        return $models;
    }
}
