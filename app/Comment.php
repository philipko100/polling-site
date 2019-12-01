<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Table Name
    protected $table = 'comments';
    // Primary Key
    public $primaryKey = 'id';
    // timestamps in database
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
   
    public function subcomments(){
        return $this->hasMany('App\Subcomment');
    }
}
