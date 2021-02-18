<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'type',
    ];
    public function posts(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
