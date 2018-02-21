<?php

namespace App;

class Procedure extends BaseModel
{
    const UPLOAD_DESTINATION_PATH = 'files/procedures/';

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
        'file',
        'status',
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
    
    /**
     * 
     * @param type $ext
     */
    public function generateFilename($ext)
    {
        return str_slug($this->name . ' ' . \Carbon\Carbon::now()->toTimeString()) . '.' . $ext;
    }
}
