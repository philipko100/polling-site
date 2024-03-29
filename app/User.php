<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'political_position',
        'gender', 'birth_date', 'current_country', 'current_province',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function subcomments(){
        return $this->hasMany('App\Subcomment');
    }
    public function savedposts(){
        return $this->hasMany('App\SavedPost');
    }
    public function savedcomments(){
        return $this->hasMany('App\SavedComment');
    }
    public function socialProviders(){
        return $this->hasMany(SocialProvider::class);
    }
}
