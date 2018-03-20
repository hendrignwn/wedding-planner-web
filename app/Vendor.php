<?php

namespace App;

use Carbon\Carbon;

class Vendor extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/vendors/';
    const UPLOAD_DESTINATION_PATH_THUMB = 'files/vendors/thumbs/';
    
    private $_thumbPath;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'vendor';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'name',
        'description',
        'file',
        'address',
        'phone',
        'instagram',
        'website',
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
        'vendorDetails'
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
    
    public function vendorDetails()
    {
        return $this->hasMany('\App\VendorDetail', 'vendor_id', 'id');
    }
    
    public function getFileUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH . $this->file);
    }
    
    public function getFileThumbUrl()
    {
        return url(self::UPLOAD_DESTINATION_PATH_THUMB . $this->file);
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
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . Carbon::now()->toTimeString()) . '.' . $ext;
    }
    
	/**
	 * set path
	 * 
	 * @param string $value
	 */
	public function setThumbPath($value)
	{
		$this->_thumbPath = $value;
	}
	
	/**
	 * @return string
	 */
	public function getThumbPath()
	{
		return $this->_thumbPath;
	}
    
    public function deleteFile($file = null)
    {
        if ($file == null) {
            $file = $this->file;
        }
        @unlink($this->getPath() . $file);
    }
    
    public function deleteThumbFile($file = null)
    {
        if ($file == null) {
            $file = $this->file;
        }
        @unlink($this->getThumbPath() . $file);
    }
    
    public function deleteAllFiles()
    {
        $this->deleteFile();
        $this->deleteThumbFile();
        foreach ($this->vendorDetails as $detail) :
            $detail->deleteFileAndThumb();
        endforeach;
        
        return true;
    }
}
