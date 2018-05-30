<?php

namespace App;

use Carbon\Carbon;

class ProcedureAdministration extends BaseModel
{
    const CHECKLIST_TRUE = 1;
    const CHECKLIST_FALSE = 0;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'procedure_administration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_relation_id',
        'user_id',
        'procedure_id',
        'checklist',
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
    
    public function procedure() 
    {
        return $this->hasOne('\App\Procedure', 'id', 'procedure_id');
    }
}
