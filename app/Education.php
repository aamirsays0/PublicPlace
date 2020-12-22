<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'institute','sess','level','major', 'description', 'graduate','user_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
