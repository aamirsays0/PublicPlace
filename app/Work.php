<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'company','designation', 'workfrom','workto', 'working', 'description','city','user_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
 
}
