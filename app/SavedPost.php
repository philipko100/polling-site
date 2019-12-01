<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedPost extends Model
{
    // Table Name
    protected $table = 'saved_rating_posts';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
