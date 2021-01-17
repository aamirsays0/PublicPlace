<?php

namespace App\Http\Controllers;
use App\User;
use App\Friend;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Custom\FriendsList;
use App\Post;
class Searchcontroller extends Controller
{
   
    public function index(Request $request){
        $this->validate($request, [
            'search' => 'required'
        ]);
        $id = Auth::id();
        $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();
        /* echo "search called : " .$request->search;
        dd($request); */
    // $sentRequest = Friend::where('user_id',Auth::id())->pluck('friend_id')->toArray();
       // dd($sentRequest);
       $his_friends = Friend::where('user_id', $id)->get();
       $allFriends = FriendsList::Friends(Auth::id());
       $posts = Post::with(['user','pictures','comments.user', 'reactions'])
           ->whereIn('user_id',$allFriends)
           ->whereIn('privacy', ['public', 'friends'])
           ->Where('content','like', '%'.$request->search.'%')
           ->orderBy('created_at', 'desc')
           ->paginate(10);
 
         $profileposts = Profile::with(['user'])
         ->whereIn('user_id',$allFriends)
         ->Where('f_name','like', '%'.$request->search.'%')
         ->orderBy('created_at', 'desc')
         ->paginate(10);
         $friends = Friend::with('friendInfo')
        ->where('user_id', Auth::id())
        ->where(['approved' => 1, 'blocked' => 0])
        ->get();
         $sentRequest = FriendsList::Friends(Auth::id());
         $searchResult = User::with('profiles','friends')
        ->where('name', 'like', '%'.$request->search.'%')
        ->orWhere('email','like', '%'.$request->search.'%')
        ->orderBy('name')
        ->get();


        return view("search", compact('his_friends'))
        ->with('users', $searchResult)->with('profileposts', $profileposts)
        ->with('req', $sentRequest)->with('friends', $friends)->with('requests', $friendreq)->with('posts', $posts);
    }
    
}
