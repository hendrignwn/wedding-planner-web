<?php

namespace App;

class ReportProblem extends BaseModel
{
    const CATEGORY_FUNCTION = 1;
    const CATEGORY_DESIGN = 2;
    const CATEGORY_OTHER = 3;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'report_problem';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category',
        'description',
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
}
