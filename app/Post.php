<?php

namespace App;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use Taggable;
    // Table Name
    public $table = 'posts';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function view()
    {
        return $this->hasMany('App\View');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->whereNull('parent_id');
    }


}
