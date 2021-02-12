<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Custom\FriendsList;
use Illuminate\Support\Facades\Auth;
use App\Friend;
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $friendreq = Friend::with('user')
                ->where("friend_id",$id)
                 ->where('approved','0')
                 ->where('blocked', '0')
                 ->get();

          $friends =  Friend::whereRaw("( user_id = $id OR friend_id = $id )")
                 ->where(['approved' => 1, 'blocked' => 0])
                 ->get();
   
        return view('changePassword')->with ('friends', $friends)->with('requests', $friendreq);
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('change.password');
        //dd('Password change successfully.');
    }
}