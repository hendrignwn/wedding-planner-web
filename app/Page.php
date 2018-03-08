<?php

namespace App;

class Page extends BaseModel
{
    const CATEGORY_PRIVACY_POLICY = 1;
    const CATEGORY_ABOUT_US = 2;
    const CATEGORY_TERM_OF_USE = 3;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'page';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
    
    protected $with = [
    ];
}
