<?php

namespace App;

use App\User;
use App\StoryComment;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    //

    protected $fillable = [
        'story',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(StoryComment::class, 'story_id');
    }
}
