<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'message','user_id','friends_id','pic_id', 'read', 'deleted'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function friend()
    {
        return $this->belongsTo('App\User');
    }

}
