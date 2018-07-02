<?php

namespace App;

class UserRelationConcept extends BaseModel
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_relation_concept';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_relation_id',
        'user_id',
        'name',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_relation_id',
        'user_id',
    ];
    
    public function userRelation()
    {
        return $this->hasOne('\App\UserRelation', 'id', 'user_relation_id');
    }
    
    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
    public function afterCreateAutoCreateContent() 
    {
//        $params = [
//            ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
//            ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
//            ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
//            ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
//            ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
//            ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
//        ];
//        
//        foreach ($params as $param) {
//            $model = new Content();
//        }
    }
    
}
