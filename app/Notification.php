<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'post_id', 'type', 'user_id', 'viewed'
    ];
    public function post(){
        return $this->belongTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
