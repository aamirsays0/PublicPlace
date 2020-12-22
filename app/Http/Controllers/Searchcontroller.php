<?php

namespace App\Http\Controllers;
use App\User;
use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Custom\FriendsList;

class Searchcontroller extends Controller
{
    public function index(Request $request){
        /* echo "search called : " .$request->search;
        dd($request); */
    // $sentRequest = Friend::where('user_id',Auth::id())->pluck('friend_id')->toArray();
       // dd($sentRequest);
       $allFriends = FriendsList::Friends(Auth::id());
        $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
         ->get();

         $sentRequest = FriendsList::Friends(Auth::id());

         $searchResult = User::with('profiles', 'friends')
        ->where('name', 'like', '%'.$request->search.'%')
        ->orWhere('email','like', '%'.$request->search.'%')
        ->orderBy('name')
        ->get();
        return view("search", compact('friends'))
        ->with('users', $searchResult)
        ->with('req', $sentRequest)->with('friends', $friends) ;
    }
}
