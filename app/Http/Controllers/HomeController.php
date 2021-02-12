<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Picture;
use App\Friend;
use App\Story;
use App\Custom\FriendsList;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
/*         $allpost = Post::with(['user','pictures'])->get();
 */       
    //Latest post Showing
        $id = Auth::id();
        $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();
    
                //dd($friends);
                
            /* $friends = Friend::with(['user','friendInfo'])
               ->where('approved','1')
               ->where('blocked','0')
               ->where("friend_id",$id)
               ->orWhere("user_id",$id)
            ->get();
              $friendsList =array($id);
               foreach($friends as $friend){
                   if($friend->user_id == $id){
                       $friendsList[]= $friend->friend_id;
                   }
                   else{
                       $friendsList[] = $friend->user_id;
                   }
               }
               //dd($friends);
               $friendsList = FriendsList::Friends($id);
               //dd($friendsList);
              */
              $friends =  Friend::whereRaw("( user_id = $id OR friend_id = $id )")
              ->where(['approved' => 1, 'blocked' => 0])
              ->get();
      
              $his_friends = Friend::select('user_id', 'friend_id')->whereRaw("( user_id = $id OR friend_id = $id )")->get()->toArray();
            //   dd($his_friends);
           $allpost = Post::
           with('pictures')
           ->with('videos')
           ->with('comments')
           ->with('reactions')->whereIn('privacy', ['public', 'friends'])
           ->orderBy('created_at', 'desc')
        //    Post::with(['user','pictures','comments.user', 'reactions'])
        //    ->whereIn('user_id',$allFriends)
        //    ->whereIn('privacy', ['public', 'friends'])
        //    ->orderBy('created_at', 'desc')
 //          ->skip(0)
   //        ->take(10)
     //      ->get();
           ->paginate(10);
           $sentRequest = FriendsList::Friends(Auth::id());

           $stories = Story::with('user')
           ->where('user_id', '!=', auth()->id())
           ->where('created_at', '>=', Carbon::now()->subDay())
           ->select('user_id', DB::raw('count(*) as total'))
           ->groupBy('user_id')->get();
           //dd($allpost); 
        //return view('home', compact('allpost'));
        return view('home', compact('his_friends', 'stories'))
        ->with('posts', $allpost)
        ->with('requests', $friendreq)
        ->with('friends', $friends)->with('req', $sentRequest);

    }
    public function nearby()
     {
        
        $id = Auth::id();
        $friendreq = Friend::with('friendInfo')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();
       $friends =  Friend::whereRaw("( user_id = $id OR friend_id = $id )")
                 ->where(['approved' => 1, 'blocked' => 0])
                 ->get();
         
        $sentRequest = FriendsList::Friends(Auth::id());
        $his_friends = Friend::where('user_id', $id)->get();
        $userinfo = User::whereHas('profiles', function($query) {
            $query->where('city', 'islamabad');
        } )->with(['profiles' => function($query) {
            $query->where('city', 'islamabad');
        }])->get();

         return view('peoplenearby', compact('his_friends'))
         ->with('users',$userinfo)->with('requests', $friendreq)
         ->with('friends', $friends)->with('req', $sentRequest);
 

    }
}
