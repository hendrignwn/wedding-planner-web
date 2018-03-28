<?php

namespace App;

class ContentDetailList extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/content-detail-lists/';
    
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
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $path = public_path(self::UPLOAD_DESTINATION_PATH);

        if(!is_dir($path)) {
            \File::makeDirectory($path, 0755);
        }
        $this->setPath($path);
    }
    
    public function contentDetail()
    {
        return $this->hasOne('\App\ContentDetail', 'id', 'content_detail_id');
    }
    
    public function deletePhoto()
    {
        @unlink($this->getPath() . $this->value);
    }
    
    public function getValueUrl()
    {
        return "<a href='".url(self::UPLOAD_DESTINATION_PATH . $this->value)."' target='_blank'>".url(self::UPLOAD_DESTINATION_PATH . $this->value)."</a>";
    }
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
    public static function getLastOrderByContentDetailId($id)
    {
        $model = self::where('content_detail_id', $id)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->first();
        if (!$model) {
            return 0;
        }
        
        return $model->order;
    }
}
