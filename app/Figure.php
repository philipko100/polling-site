<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Figure extends Model
{
    // Table Name
    protected $table = 'figures';
    // Primary Key
    public $primaryKey = 'id';
    // No timestamps in database
    public $timestamps = false;

    //relationship to Posts
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
