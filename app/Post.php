<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function figure(){
        return $this->belongsTo('App\Figure');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}