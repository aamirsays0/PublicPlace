<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Custom\FriendsList;
use App\Friend;
use App\User;
use App\Video;
use App\Post;
use DB;
class VideoController extends Controller
{
    public function index () {
        $id = Auth::id();
        $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();  
        $friends =  Friend::whereRaw("( user_id = $id OR friend_id = $id )")
                 ->where(['approved' => 1, 'blocked' => 0])
                 ->get();
   
              
              $videos = DB::table('videos')
              ->select(DB::raw('post_id, vidname'))
              ->where('post_id', '<>', Auth::id())
              ->orderBy('created_at','DESC')
              ->get();
        return view('showvideos', compact('videos'))->with('videos', $videos)->with('friends', $friends)->with('requests', $friendreq);
    }
}
