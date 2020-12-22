<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interests extends Model
{
    protected $fillable = [
        'interest','user_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
