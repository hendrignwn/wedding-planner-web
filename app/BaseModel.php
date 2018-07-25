<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    private $_path;
    private $_thumbPath;

    /**
     * @return array
     */
    public static function statusLabels() {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    /**
     * @return string
     */
    public function getStatusLabel() {
        $list = self::statusLabels();

        return $list[$this->status] ? $list[$this->status] : $this->status;
    }

    /**
     * @return boolean
     */
    public function getIsStatusActive() {
        return $this->status == self::STATUS_ACTIVE;
    }

    /**
     * @param type $query
     * @return query
     */
    public function scopeActived($query) {
        return $query->where($this->table . '.status', self::STATUS_ACTIVE);
    }

    /**
     * @param type $query
     * @return query
     */
    public function scopeOrdered($query) {
        return $query->orderBy($this->table . '.order', 'asc');
    }

    /**
     * set path
     * 
     * @param string $value
     */
    public function setPath($value) {
        $this->_path = $value;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->_path;
    }

    /**
     * set path
     * 
     * @param string $value
     */
    public function setThumbPath($value) {
        $this->_thumbPath = $value;
    }

    /**
     * @return string
     */
    public function getThumbPath() {
        return $this->_thumbPath;
    }

}
