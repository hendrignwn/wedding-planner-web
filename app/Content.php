<?php

namespace App;

use Illuminate\Support\Facades\DB;

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
    
    public function triggerInsertContentDetails()
    {
        $params = [
            ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
            ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
            ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
            ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
            ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
            ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
        ];
        
        DB::beginTransaction();
        foreach ($params as $param) {
            $contentDetail = new ContentDetail();
            $contentDetail->fill($param);
            $contentDetail->content_id = $this->id;
            $contentDetail->save();
        }
        DB::commit();
        
        return true;
    }
}
