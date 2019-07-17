<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcomment extends Model
{
    // Table Name
    protected $table = 'subcomments';
    // Primary Key
    public $primaryKey = 'id';
    // timestamps in database
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comment(){
        return $this->belongsTo('App\Comment');
    }
}
