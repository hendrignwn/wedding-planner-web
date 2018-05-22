<?php

namespace App;

use Carbon\Carbon;

class VendorDetail extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/vendor-details/';
    const UPLOAD_DESTINATION_PATH_THUMB = 'files/vendor-details/thumbs/';
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'vendor_detail';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'name',
        'file',
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
        $pathThumb = public_path(self::UPLOAD_DESTINATION_PATH_THUMB);

        if(!is_dir($path)) {
            \File::makeDirectory($path, 0755);
        }
        if(!is_dir($pathThumb)) {
            \File::makeDirectory($pathThumb, 0755);
        }
        $this->setPath($path);
        $this->setThumbPath($pathThumb);
    }
    
    public function vendor()
    {
        return $this->hasOne('\App\Vendor', 'id', 'vendor_id');
    }
    
    public function getFileUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->file);
    }
    
    public function getFileThumbUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH_THUMB . $this->file);
    }
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
    public function deleteFileAndThumb()
    {
        @unlink($this->getPath() . $this->file);
        @unlink($this->getThumbPath() . $this->file);
    }
    
    public function getFileThumbImg()
    {
        if ($this->file != null) {
            return "<img src='{$this->getFileThumbUrl()}' width='150' />";
        }
        
        return null;
    }
    
    public function getFileImg()
    {
        if ($this->file != null) {
            return "<img src='{$this->getFileUrl()}' width='100%' />";
        }
        
        return null;
    }
}
