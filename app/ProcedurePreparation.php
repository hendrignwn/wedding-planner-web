<?php

namespace App;

use Carbon\Carbon;

class ProcedurePreparation extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'procedure_preparation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_relation_id',
        'user_id',
        'name',
        'venue',
        'preparation_at',
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
    
    public function userRelation() 
    {
        return $this->hasOne('\App\UserRelation', 'id', 'user_relation_id');
    }
    
    public function user() 
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
}
