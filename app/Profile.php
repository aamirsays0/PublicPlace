<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'f_name','l_name', 'u_mail','dob', 'sex', 'city', 'country', 'user_id', 'pp', 'cp'
    ];
    public function profiles(){
        return $this->belongsTo('App\User');
    }
}
