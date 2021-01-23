<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Post;
use App\Picture;
use App\Video;
use App\Friend;
use App\User;
use App\Reaction;
use App\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Custom\FriendsList;
use Validator;
use DB;
//use Illuminate\Http\Response;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class PostController extends Controller
{
    private $p;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // configure with favored image driver (gd by default)
        //Image::configure(array('driver' => 'imagick'));

    // Validate all fields;
        $rules = [
            'content' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:8000',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['messages' => $validator->getMessageBag()->toArray()], 422);
        }

        $newPost = new Post();
        $newPost->content = $request->content;
        $newPost->privacy = $request->privacy;
        $newPost->user_id = Auth::id();
        $newPost->save();
        if($newPost->id){
            //
            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $image){
                    $name=time()."_".Auth::id()."_".$image->getClientOriginalName();
 
                    //MOVE IMAGE INTO POSTIMAGES FOLDER             
                        $image->move(public_path().'/storage/postimages/',$name);
                        // and you are ready to go ...
                        $resizedImage = Image::make(public_path().'/storage/postimages/' .$name)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });


//save the file as jpg with medium quality
       $resizedImage->save(public_path().'/storage/postimages/'.$name, 60);
       $data[] = $name;            
       //INSERT INTO PICTURE TABLE
                    $pic = new Picture();
                    $pic->imgname = $name;
                    $newPost->pictures()->save($pic);
                }
            }
            if($request->hasfile('videos'))
            {
                foreach($request->file('videos') as $vidage){
                    $name=time()."_".Auth::id()."_".$vidage->getClientOriginalName();
 
                    //MOVE IMAGE INTO POSTIMAGES FOLDER             
        $vidage->move(public_path().'/storage/postvideos/',$name);
        // and you are ready to go ...
//         $resizedVidage = Image::make(public_path().'/storage/postimages/' .$name)->resize(800, null, function ($constraint) {
//     $constraint->aspectRatio();
// });


//save the file as jpg with medium quality
    //    $resizedVidage->save(public_path().'/storage/postimages/'.$name, 60);
       $data[] = $name;            
       //INSERT INTO PICTURE TABLE
                    $vid = new Video();
                    $vid->vidname = $name;
                    $newPost->videos()->save($vid);
                }
            }
            //activity
            $a = new Activity();
            $a->post_id = $newPost->id;
            $a->type= 'post';
            $a->user_id = Auth::id();
            $a->save();
            //pusher
            
            $data['message'] = 'New Post From: '.Auth::user()->name;
            $data['type'] = 'post';
            $data['pid'] = $newPost->id;
            $data['user_id'] = Auth::id();
            //find friends start
            
            $friendsList = FriendsList::Friends(Auth::id());
            if($request->privacy !== "me"){

            foreach($friendsList as $fl){
                $this->p->trigger('user-'.$fl, 'new-post', $data);
            }}
//
            return response()->json([
                'success' => true,
                'message' => 'Post Created'
            ]);
            //event(new PostCreated($newPost));
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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userpost = Post::
          with('pictures')
          ->with('videos')
          ->with('comments')
          ->with('reactions')
        ->find($id);
        $allFriends = FriendsList::Friends(Auth::id());
        $his_friends = Friend::where('user_id', $id)->get();
        $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
         ->get();
         $sentRequest = FriendsList::Friends(Auth::id());
         $id = Auth::id();
        $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')->get();
        /* 

        $friends = Friend::with(['user','friendinfo'])
        ->where('approved','1')
        ->where('blocked','0')
        ->where('friend_id',$id)
        ->orWhere('user_id',$id)
        ->get(); */
    if($userpost->privacy === "friends" ){
       if(Friend::where('friend_id',Auth::id())->where('user_id',$userpost->user_id)->get()->count() || Friend::where('friend_id',$userpost->user_id)->where('user_id',Auth::id())->get()->count()){
        
        $friendsList = FriendsList::Friends($id);
        return view('single_post', compact('his_friends'))->with('userpost', $userpost)->with('friends', $friends)->with('requests', $friendreq)->with('req', $sentRequest) ;
               }
        else{
                return view('single_post_404')->with ('friends', $friends);
    
            }

        }
        else{
            return view('single_post', compact('his_friends'))->with('userpost', $userpost)->with('friends', $friends)->with('requests', $friendreq)->with('req', $sentRequest);

        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id == Auth::id()){
            if(Post::destroy($post->id)){
                return redirect('home')->with('success', 'Post Deleted!!');
            }
            else{
                return redirect()->route('home')
                ->with('success', 'Problem Deleting post!');
            }
        }
    }
    public function postcomment(Request $request,$id){
        $this->validate($request, [
            'postcomment' => 'required'
        ]);
        
        //echo $id;
        //dd($request->toArray());
        $newComment = new Comment();
        $newComment->comment = $request->postcomment;
        $newComment->user_id= Auth::id();
        Post::Find($id)->comments()->save($newComment);

        $this->reaction($id, 'comment');
        if($newComment->id){
            return back()->with('success', 'Comment Added!!');

        }
        else{
            return back()->with('success', 'Error in comment!!');

        }
    }
    public function deleteComment(comment $comment)
    {
        if (auth()->user()->is($comment->user)) {
            $comment->delete();
        }
        return redirect()->back()->with('success', 'Comment Deleted!!');
    }

    public function react(Request $request){
        //echo "hi";
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
        $this->reaction($post->id, 'react');


        if($post->reactions()->save($reaction)){
            $reactionsCounter = Reaction::where('post_id', $request->postid)->get();
            $liked = $reactionsCounter->where('type', 'l')->count();
            $disliked = $reactionsCounter->where('type', 'd')->count();
            $loved = $reactionsCounter->where('type', 'h')->count();
            $smiled = $reactionsCounter->where('type', 's')->count();

            $data['message'] = Auth::user()->name.' '.$reactType. ' a Post from ' . $postuser;
            $data['type'] = 'reaction';
            $data['sender_id'] = Auth::id();
            $this->p->trigger('user-'.$post->user_id, 'new-post', $data);
            return response()->json([
                'success' => true,
                'message' => 'Reacted',
                'liked' => $liked,
                'disliked' => $disliked,
                'loved' => $loved,
                'smiled' => $smiled
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ]);
        }


    }
    public function images()
    {
        $id = Auth::id();
        $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();
        $allFriends = FriendsList::Friends($id);
              $friends = User::with('profiles')
              ->whereIn('id',$allFriends)
              ->get();
              $images = DB::table('pictures')
              ->select(DB::raw('post_id, imgname'))
              ->where('post_id', '<>', Auth::id())
              ->orderBy('created_at','DESC')
              ->get();
              return view('imageuploaded', compact('images'))->with('images', $images)->with('friends', $friends)->with('requests', $friendreq);
    }

    public function reaction($id, $type){
        // add activity to activities table;
        $activity = new Activity();
        $activity->user_id=Auth::id();
        $activity->post_id=$id;
        $activity->type=$type;
        $activity->save();
    }    
}
