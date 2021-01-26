<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Friend;
use Illuminate\Support\Facades\Auth;
use App\Custom\FriendsList;
use App\Profile;
use RealRashid\SweetAlert\Facades\Alert;

class FriendController extends Controller
{
        
    public function add($id){
        if(!Friend::where('user_id',Auth::id())
        ->where('friend_id',$id)
        ->count() && !Friend::where('friend_id',Auth::id())
        ->where('user_id',$id)
        ->count()){
            $newF = new Friend();
            $newF->user_id = Auth::id();
            $newF->friend_id = $id;
            $newF->save();
            if($newF->id){
                return response()->json(['success'=>'true','message'=>'request sent']);
            }
            else{
                return response()->json(['success'=>'false','message'=>'Problem !!']);    
            }
            }
        else{
                return response()->json(['success'=>'false','message'=>'Already Sent !!']);    

        }

    

       // return response("hi ".$id);
       // return response.json(['success'=>'true','message'=>'request sent']);
    }
    public function confirm($id){
    $f = Friend::where('user_id',$id)
        ->where('friend_id',Auth::id())
        ->where('approved', '0')
        ->where('blocked', '0')
        ->update(['approved'=>'1']);
     if($f){
                return response()->json(['success'=>'true','message'=>'You are now Friends. ']);
            }
          else{
                return response()->json(['success'=>'false','message'=>'Problem !! ']);    
            }

          

    } 

    public function deleteFriend($id){
        $f = Friend::findOrFail($id)
            ->where('friend_id',Auth::id())
            ->where('approved', '0')
            ->where('blocked', '0')
            ->update(['blocked'=>'1']);
         if($f){
            return response()->json(['success'=>'true','message'=>'Request cancelled successfully. ']);
        }
        else{
            return response()->json(['success'=>'false','message'=>'Problem !! ']);    
        }
    } 
    
    public function showFriends($id)
    {   $id = Auth::id();
        $friendreq = Friend::with('user')
               ->where("friend_id",$id)
                ->where('approved','0')
                ->where('blocked', '0')
                ->get();

        $allFriends = FriendsList::Friends($id);
         $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
        ->get();


        return view('friendslist')->with('friends', $friends)->with('requests', $friendreq);
    }

    public function unfriend($id){
        $friend = Friend::findOrFail($id);

        if (empty($friend)) return response()->json(['message' => 'friend not found'], 404);

        $friend->delete();

        return response()->json(['message' => 'Friend have been unfriendded'], 200);
  
    }
    public function userFriends($id)
    {    $id = Auth::id();
         $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();
       
        $user_information = User::with('profiles')->findOrFail($id);
        $allFriends = FriendsList::Friends($id);
         $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
        ->get();
        return view('userFriends', compact('user_information'))->with('friends', $friends)->with('requests', $friendreq);
    }

}
