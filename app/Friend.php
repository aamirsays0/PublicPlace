<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Profile;
class Friend extends Model
{
    protected $fillable = [
        'user_id', 'friend_id', 'approved','blocked'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function friendInfo(){
        return $this->belongsTo('App\User', 'friend_id');
    }
}
