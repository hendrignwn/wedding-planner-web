<?php

namespace App;

class Content extends BaseModel
{
    const IS_NOT_DELETED_TRUE = 1;
    const IS_NOT_DELETED_FALSE = 0;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'content';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'concept_id',
        'grouping',
        'user_relation_id',
        'user_id',
        'name',
        'description',
        'status',
        'order',
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
    
    protected $with = [
    ];
    
    public function concept()
    {
        return $this->hasOne('\App\Concept', 'id', 'concept_id');
    }
    
    public function userRelation()
    {
        return $this->hasOne('\App\UserRelation', 'id', 'user_relation_id');
    }
    
    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
    public function contentDetails()
    {
        return $this->hasMany('\App\ContentDetail', 'content_id', 'id');
    }
}
