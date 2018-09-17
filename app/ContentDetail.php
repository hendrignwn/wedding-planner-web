<?php

namespace App;

class ContentDetail extends BaseModel
{
    const IS_NOT_DELETED_TRUE = 1;
    const IS_NOT_DELETED_FALSE = 0;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'content_detail';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content_id',
        'name',
        'value',
        'is_noted',
        'is_photo',
        'is_video',
        'is_link',
        'is_cost',
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
    
    public function content()
    {
        return $this->hasOne('\App\Content', 'id', 'content_id');
    }
    
    public function contentDetailLists()
    {
        return $this->hasOne('\App\ContentDetailList', 'id', 'content_detail_id');
    }
    
    public function getLinkIsTrue()
    {
        return $this->is_link == true;
    }
    
    public function getCostIsTrue()
    {
        return $this->is_cost == true;
    }
    
    public static function getLastOrderByContentId($id)
    { 
        $model = self::where('content_id', $id)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->first();
        if (!$model) {
            return 0;
        }
        
        return (int)$model->order;
    }
}
