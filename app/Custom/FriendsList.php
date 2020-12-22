<?php

namespace App\Custom;
use App\Friend;
use App\DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FriendsList
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function Friends($id){
        //find friends start
        //$id = Auth::id();
        $friends1 = Friend::with(['user','friendinfo'])
            ->where("user_id", $id)
            ->where('approved', '1')
            ->where('blocked', '0')
            ->get();
            $friends2 = Friend::with(['user','friendinfo'])
            ->where("friend_id", $id)
            ->where('approved', '1')
            ->where('blocked', '0')
            ->get();
            $allFriends = $friends1->merge($friends2);
        $friendsList =array((int)$id);
        foreach($allFriends as $friend){
            if($friend->user_id == $id){
                $friendsList[]= $friend->friend_id;
            }
            else{
                $friendsList[] = $friend->user_id;
            }
        }
        return $friendsList;
    }
    public static function Flist($id){
        //find friends start
        //$id = Auth::id();
        $friends1 = Friend::with(['friends'])
            ->where("user_id", $id)
            ->where('approved', '1')
            ->where('blocked', '0')
            ->get();
            $friends2 = Friend::with(['friends'])
            ->where("friend_id", $id)
            ->where('approved', '1')
            ->where('blocked', '0')
            ->get();
            $allFriends = $friends1->merge($friends2);
        $friendsList =array((int)$id);
        foreach($allFriends as $friend){
            if($friend->user_id == $id){
                $friendsList[]= $friend->friend_id;
            }
            else{
                $friendsList[] = $friend->user_id;
            }
        }
        return $friendsList;
    }
}