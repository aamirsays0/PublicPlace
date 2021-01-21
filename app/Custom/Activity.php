<?php
namespace App\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Activity
{
    public static function getview($singleActivity){
        $html="";
        if($singleActivity->type == "post"){
        $html .='
        <p style="border-bottom: 1px solid #b5d7f3;padding: 5px;font-size: 1.7rem !important;">   
        <img src="'.asset('storage/profile/'.$singleActivity->user_id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" />

          <a style="font-size: 1.7rem !important;" href="'.route('profiles.show',Auth::id()).'">'."You".'</a>
            Created a new <a style="font-size:1.7rem" href="'.url('posts/'.$singleActivity->post_id).'"> 
            post
          </a>.

        </p>';
    }
        elseif($singleActivity->type == "comment"){
        $html .='<p style="border-bottom: 1px solid #b5d7f3;padding: 5px;font-size: 1.7rem;">
          <img src="'.asset('storage/profile/'.$singleActivity->user->id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" />
          <a  style="font-size: 1.7rem !important;" href="'.route('profiles.show',Auth::id()).'">'."You".'</a>
            Commented on a <a style="font-size:1.7rem" href="'.url('posts/'.$singleActivity->post_id).'"> 
            post
          </a>.
          </p>';
        }
        elseif($singleActivity->type == "react"){
        $html .='<p style="border-bottom: 1px solid #b5d7f3;padding: 5px;font-size: 1.7rem;">
           <img src="'.asset('storage/profile/'.$singleActivity->user_id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" />
          <a  style="font-size: 1.7rem !important;" href="'.route('profiles.show',Auth::id()).'">'."You".'</a>
           reacted on a <a style="font-size:1.7rem" href="'.url('posts/'.$singleActivity->post_id).'">
            post
         </a>.</
         p>';
        }
        elseif($singleActivity->type == "share"){
        $html .='<p style="border-bottom: 1px solid #b5d7f3;padding: 5px;font-size: 1.7rem;">
           <img src="'.asset('storage/profile/'.$singleActivity->user_id.'_profile_thumb.jpg').'" alt="user" class="img-fluid profile-photo profile-photo-md" />
          <a  style="font-size: 1.7rem !important;" href="'.route('profiles.show',Auth::id()).'">'."You".'</a>
           shared a <a style="font-size:1.7rem" href="'.url('posts/'.$singleActivity->post_id).'">
            post
         </a>.</
         p>';
        }
        else{
        }
        return $html;

    }

}