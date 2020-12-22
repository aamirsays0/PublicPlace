<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        if(Auth::check){
            return redirect("home");
        }
        else{
            return view("welcome");
        }
    }
}
