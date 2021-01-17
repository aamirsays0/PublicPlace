<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
class VideoController extends Controller
{
    public function index () {
        $videos = Video::orderBy('created_at')->get();
        return view('showvideos', compact('videos'));
    }
}
