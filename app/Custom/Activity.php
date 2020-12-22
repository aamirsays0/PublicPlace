<?php
namespace App\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Activity
{
    public static function getview($singleActivity){
        $html="";
        if($singleActivity->type == "post"){
        $html .='<p style="border-bottom: 1px solid #b5d7f3;padding: 5px"><img src="'.asset('storage/profile/'.$singleActivity->user_id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" /><a href="'.url('profile/'.Auth::id()).'">'.Auth::user()->name.'</a> <a>Create a new</a> <a href="'.url('posts/'.$singleActivity->post_id).'"> post</a>.</p>';
    }
        elseif($singleActivity->type == "comment"){
        $html .='<p style="border-bottom: 1px solid #b5d7f3;padding: 5px"><img src="'.asset('storage/profile/'.$singleActivity->post->user->id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" /><a href="'.url('profile/'.Auth::id()).'">'.Auth::user()->name.'</a> <a>Commented on a </a><a href="'.url('posts/'.$singleActivity->post_id).'"> post</a>.</p>';
        }
        elseif($singleActivity->type == "react"){
        $html .='<p style="border-bottom: 1px solid #b5d7f3;padding: 5px"><img src="'.asset('storage/profile/'.$singleActivity->user_id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" /><a href="'.url('profile/'.Auth::id()).'">'.Auth::user()->name.'</a><a> reacted on a </a><a href="'.url('posts/'.$singleActivity->post_id).'"> post</a>.</p>';
        }
        elseif($singleActivity->type == "share"){
        $html .='<p style="border-bottom: 1px solid #b5d7f3;padding: 5px"><img src="'.asset('storage/profile/'.$singleActivity->user_id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" /><a href="'.url('profile/'.Auth::id()).'">'.Auth::user()->name.'</a><a> shared on a </a><a href="'.url('posts/'.$singleActivity->post_id).'"> post</a>.</p>';
        }
        else{
        }
        return $html;

    }

}