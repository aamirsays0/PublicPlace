<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'vidname', 'post_id'
    ];
    public function posts(){
        return $this->belongsTo('App\Post');
    }
}
