<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Post;
use DB;
class VideoController extends Controller
{
    public function index () {
        DB::table('videos')->first();
        $videos = Video::orderBy('created_at')->get();
        return view('showvideos', compact('videos'));
    }
}
