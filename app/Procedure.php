<?php

namespace App;

use Carbon\Carbon;

class Procedure extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'procedure';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'order',
    ];
    
    protected $appends = [
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
    
    public function procedureAdministration()
    {
        return $this->hasOne('\App\ProcedureAdministration', 'procedure_id', 'id');
    }
    
    public function getChecklistAttribute()
    {
        if (!$this->procedureAdministration) {
            return 0;
        }
        
        if ($this->procedureAdministration->checklist == ProcedureAdministration::CHECKLIST_FALSE) {
            return 0;
        }
        
        return 1;
    }
}
