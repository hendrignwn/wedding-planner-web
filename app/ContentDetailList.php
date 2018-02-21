<?php

namespace App;

class ContentDetailList extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'content_detail_list';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content_detail_id',
        'name',
        'value',
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
    
    public function contentDetail()
    {
        return $this->hasOne('\App\ContentDetail', 'id', 'content_detail_id');
    }
}
