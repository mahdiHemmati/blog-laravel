<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    // Table Name
    protected $table = 'views';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

//    public function getRouteKey()
//    {
//        return 'name';
//    }
//
//    public function getNameAttribute() {
//        return strtoupper($this->name);
//    }
//
//    public function setNameAttribute($name) {
//        return $this->attributes['name'] = strtolower($name);
//    }
}
