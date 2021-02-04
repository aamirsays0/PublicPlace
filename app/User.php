<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function profiles(){
        return $this->hasOne('App\Profile');
    }
    
    public function posts(){
        return $this->hasMany('App\Post')->orderBy('created_at','desc');
    }
    public function education(){
        return $this->hasMany('App\Education');
    }
    public function works(){
        return $this->hasMany('App\Work');
    }
    public function interests(){
        return $this->hasMany('App\Interests');
    }
    public function comments()
    {
        return $this->hasManyThrough('App\Comment', 'App\Post');
    }
    public function friends(){
        return $this->hasMany('App\Friend');
    }
    public function friend(){
        return $this->hasMany('App\Friend', 'user_id', 'id');
    }
    public function friends2(){
        return $this->hasMany('App\Friend', 'friend_id', 'id');
    }
    public function chats(){
        return $this->hasMany('App\Chat');
    }
    public function chats2(){
        return $this->hasMany('App\Chat', 'friends_id', 'id');
    }
    public function activity(){
        return $this->hasMany('App\Activity');
    }
    public function notification(){
        return $this->hasMany('App\Notification');
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function receivesBroadcastNotificationsOn() {
        return 'users.'.$this->id;
    }
}
