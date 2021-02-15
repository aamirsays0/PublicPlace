<?php

namespace App\Http\Controllers;

use App\Story;
use App\User;
use App\StoryComment;
use App\Friend;
use App\Custom\FriendsList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $id = auth()->id();
        $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();

        $friends =  Friend::whereRaw("( user_id = $id OR friend_id = $id )")
        ->where(['approved' => 1, 'blocked' => 0])
        ->get();

        $stories = Story::with('comments')
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->where('user_id', $id)->get();


        return view('stories.form', compact('stories', 'friends'))->with('requests', $friendreq);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'story' => 'required| max:20000'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $story = new Story;

        foreach($request->file('story') as $video) {

            $name = time()."_".auth()->id()."_".$video->getClientOriginalName();
            $video->move(public_path().'/videos/stories', $name);

            $story->story   = $name;
            $story->user_id = auth()->id();

            $story->save();
        }
        return back()->with('message', 'Saved successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story, $id)
    {
        $friendreq = Friend::with('user')
        ->where("friend_id",Auth::id())
         ->where('approved','0')
         ->where('blocked', '0')
         ->get();
        $sentRequest = FriendsList::Friends(Auth::id());
        $ids = auth()->id();
        $friends =  Friend::whereRaw("( user_id = $ids OR friend_id = $ids )")
        ->where(['approved' => 1, 'blocked' => 0])
        ->get();

        $story_data = $story->where('id', $id)->with('comments', 'user')->first();
        return view('stories.show', compact('story_data', 'friends'))->with('req', $sentRequest)
        ->with('requests', $friendreq);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }
    
    public function friendsStory(User $user, $id)
    {
        $friendreq = Friend::with('user')
        ->where("friend_id",Auth::id())
         ->where('approved','0')
         ->where('blocked', '0')
         ->get();
         $ids = auth()->id();
         $friends =  Friend::whereRaw("( user_id = $ids OR friend_id = $ids )")
         ->where(['approved' => 1, 'blocked' => 0])
         ->get();
 
        $stories = $user->with('stories')->where('id', $id)->first();

        return view('stories.friends', compact('stories', 'friends'))->with('requests', $friendreq);
    }
}
