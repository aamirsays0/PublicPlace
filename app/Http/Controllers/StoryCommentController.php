<?php

namespace App\Http\Controllers;

use App\StoryComment;
use Illuminate\Http\Request;

class StoryCommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = StoryComment::create([
            'user_id' => auth()->id(),
            'story_id'=> $id,
            'comments' => $request->comment
        ]);

        $data = [
            'profile_pic' => asset('storage/profile/'.auth()->id().'_profile.png'),
            'user_name'   => auth()->user()->name,
            'comment'     => $request->comment,
            'comment_id'  => $comment->id
        ];

        return response()->json([ 'message' => 'Comment Added Successfully', 'data' => $data ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoryComment  $storyComment
     * @return \Illuminate\Http\Response
     */
    public function show(StoryComment $storyComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoryComment  $storyComment
     * @return \Illuminate\Http\Response
     */
    public function edit(StoryComment $storyComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoryComment  $storyComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoryComment $storyComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoryComment  $storyComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoryComment $storyComment, $id)
    {
        if ($id) {
            $storyComment->where('id', $id)->first()->delete();
            return response()->json(['success' => 'Comment Deleted Successfully'], 200);
        }else {
            return response()->json(['error' => 'Comment Not Found'], 422);
        }

        return response()->json(['error' => 'Error'], 500);
    }
}
