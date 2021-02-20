<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type', 'user_id', 'notification'
    ];
    public function post(){
        return $this->belongTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
