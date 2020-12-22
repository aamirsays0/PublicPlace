<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id','content', 'privacy', 'user_id',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function pictures(){
        return $this->hasMany('App\Picture');
    }
    public function videos(){
        return $this->hasMany('App\Video');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function reactions(){
        return $this->hasMany('App\Reaction');
    }
    public function activity(){
        return $this->hasMany('App\Activity');
    }
    public function notification(){
        return $this->hasMany('App\Notification');
    }
}
