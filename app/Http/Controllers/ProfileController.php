<?php

namespace App\Http\Controllers;
use App\Custom\FriendsList;
use App\Profile;
use App\Post;
use App\Picture;
use App\User;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
     /**
    * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function __construct()
    {
        $this->middleware('auth');
        $options = array(
            'cluster' => 'ap2',
            'usTLS' => true
        );
        $this->p = new Pusher(
            '0e8a23a77d5e825ac0fc',
            '31895c6c7d3ced73c6bc',
            '1096491', $options
        );
    }
     public function index()
     {
        $allFriends = FriendsList::Friends(Auth::id());

        $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
         ->get();
        $userinfo = User::with('profiles')->find(Auth::id());
         $countryList = config('country.list');
         $allActivity = Activity::with('post.user')->where('user_id',Auth::id())->orderBy('created_at','desc')->limit(10)->get(); 
         return view('profiles')
         ->with('user',$userinfo)
         ->with('country',$countryList)->with('allActivity',$allActivity)->with ('friends', $friends) ;

    //    dd($allActivity);
    }
     

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $editPro_basic = new Profile();
        $editPro_basic = Profile::firstOrNew(['user_id' => Auth::id()]);
        $editPro_basic->f_name = $request->firstname;
        $editPro_basic->l_name = $request->lastname;
        $editPro_basic->u_mail = $request->Email;
        $editPro_basic->dob = $request->dob;
        $editPro_basic->sex = $request->sex;
        $editPro_basic->city = $request->city;
        $editPro_basic->country = $request->country;
        $editPro_basic->user_id = Auth::id();
        if($request->hasfile('ppic')){
            $name=Auth::id()."_profile.".$request->file('ppic')->getClientOriginalExtension();
            $name_thumb=Auth::id()."_profile_thumb.".$request->file('ppic')->getClientOriginalExtension();
            $icon_thumb=Auth::id()."_icon.".$request->file('ppic')->getClientOriginalExtension();
            //dd($name);
            $request->file('ppic')->move(public_path().'/storage/profile/',$name);
            $resizedImage = Image::make(public_path().'/storage/profile/' .$name)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumb = Image::make(public_path().'/storage/profile/' .$name)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage_icon = Image::make(public_path().'/storage/profile/' .$name)->resize(48, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage->save(public_path().'/storage/profile/'.$name, 70);
            $resizedImage_thumb->save(public_path().'/storage/profile/'.$name_thumb, 70);
            $resizedImage_icon->save(public_path().'/storage/profile/'.$icon_thumb, 70);


        }
        if($request->hasfile('cpic')){
            $name=Auth::id()."_cover.".$request->file('cpic')->getClientOriginalExtension();

            $name_thumb=Auth::id()."_cover_thumb.".$request->file('cpic')->getClientOriginalExtension();
            //dd($name);
            $request->file('cpic')->move(public_path().'/storage/profile/',$name);
            $resizedImage = Image::make(public_path().'/storage/profile/' .$name)->resize(1030, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumb = Image::make(public_path().'/storage/profile/' .$name)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage->save(public_path().'/storage/profile/'.$name, 70);
            $resizedImage_thumb->save(public_path().'/storage/profile/'.$name_thumb, 70);
           
$data[] = $name;            
//INSERT INTO PICTURE TABLE
            //  $pic = new Picture();
            //  $pic->imgname = $name;
            //  $editPro_basic->pictures()->save($pic);
         }
     
     //pusher
     
     $data['message'] = 'New Post From: '.Auth::user()->name;
     $data['type'] = 'post';
     $data['pid'] = $editPro_basic->id;
     $data['user_id'] = Auth::id();
     //find friends start
     
     $friendsList = FriendsList::Friends(Auth::id());
     if($request->privacy !== "me"){

     foreach($friendsList as $fl){
         $this->p->trigger('user-'.$fl, 'new-post', $data);
     }}

        $editPro_basic->save();
        if($editPro_basic->id){
            return response()->json([
                'success' => true,
                'message' => 'Successfully updated'
            ]);

        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something is wrong'
            ]);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $allFriends = FriendsList::Friends(Auth::id());

        $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
         ->get();
        // $userinfo = FriendsList::Friends(Auth::id());
       
        $userinfo = User::with('profiles')
             ->with('posts')
             ->with('posts.pictures')
             ->with('posts.videos')
             ->with('posts.comments.user')
             ->with('posts.reactions')->paginate(10)
            //  ->with('education')
            //  ->with('works')
            //  ->with('interests')->paginate(10)
             ->find($id)
             
             ;


            //  $user_information = User::findOrFail($id);

             $allActivity = Activity::with('post.user')->where('user_id',Auth::id())->orderBy('created_at','desc')->limit(4)->get();
             return view('showprofile')->with('user', $userinfo)->with('allActivity',$allActivity)->with('friends', $friends)
           /*  ->with('user_information', $user_information)*/ ;
    }
    
    public function react(Request $request){
        //echo "hi";
        //return;
        //return response()->json($request);
        
        $this->validate($request, [
            'postid' => 'required',
            'react' => 'required'
        ]);
        $reaction = Reaction::firstOrNew([
            'post_id'=>$request->postid,
            'user_id'=> Auth::id()
        ]);
        $reaction->user_id = Auth::id();
        $reaction->type = $request->react;
        $reactType = "";
        if ($request->react === "l"){$reactType = "liked";}
        else if ($request->react === "d"){$reactType = "disliked";}
        else if ($request->react === "h"){$reactType = "loved";}
        else if ($request->react === "s"){$reactType = "Smiled";}
        else{}



        $post = Post::find($request->postid);
        $postuser = $post->user->name;

        if($post->reactions()->save($reaction)){
            $data['message'] = Auth::user()->name.''.$reactType. ' a Post from' . $postuser;
            $data['type'] = 'reaction';
            $this->p->trigger('user-'.$post->user_id, 'new-post', $data);
            return response()->json([
                'success' => true,
                'message' => 'Reacted'
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ]);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function edit(profiles $profiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profiles $profiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(profiles $profiles)
    {
        
    }
    public function showFriends($id)
    {
        $allFriends = FriendsList::Friends($id);
         $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
        ->get();
        return view('friendslist')->with('friends', $friends);
 
        
    }

    public function viewFriendsProfile($id) {
        if ($id) {
            $friends = User::with('profiles')
            ->where('id',$id)
            ->get();
            $userinfo = User::with('profiles')->find($id);
            $countryList = config('country.list');
            $allActivity = Activity::with('post.user')->where('user_id',$id)->orderBy('created_at','desc')->limit(10)->get(); 
            return view('showfriendsprofile')
            ->with('user',$userinfo)
            ->with('country',$countryList)->with('allActivity',$allActivity)->with ('friends', $friends) ;;

            if(!empty($user)) {
                return view();
            }
        }
    }
   
}
