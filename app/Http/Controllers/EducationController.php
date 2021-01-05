<?php

namespace App\Http\Controllers;

use App\Education;
use App\User;
use App\work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Custom\FriendsList;
use App\Activity;
use Validator;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function _construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $allFriends = FriendsList::Friends(Auth::id());

        $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
         ->get();
        
       // dd(Route::current());
       $userinfo= User::with(['education','works'])->find(Auth::id());
       $allActivity = Activity::with('post.user')->where('user_id',Auth::id())->orderBy('created_at','desc')->limit(4)->get();
      //dd($userinfo);
      /*   $userid = Auth::id();
        $data['education']= Education::where('user_id', $userid)->orderBy('created_at', 'desc')->get();
        $data['work']= Work::where('user_id', $userid)->orderBy('created_at', 'desc')->get();
        dd($data); */
        return view('education')->with('userinfo',$userinfo)->with('allActivity',$allActivity)->with('friends', $friends) ;
    }
    
    public function vieweducation($id)
    {
        $allFriends = FriendsList::Friends(Auth::id());

        $friends = User::with('profiles')
        ->whereIn('id',$allFriends)
         ->get();
        
       // dd(Route::current());
       $userinfo= User::with(['education','works'])->find($id);
       $allActivity = Activity::with('post.user')->where('user_id',$id)->orderBy('created_at','desc')->limit(4)->get();
      //dd($userinfo);
      /*   $userid = Auth::id();
        $data['education']= Education::where('user_id', $userid)->orderBy('created_at', 'desc')->get();
        $data['work']= Work::where('user_id', $userid)->orderBy('created_at', 'desc')->get();
        dd($data); */
        return view('showusereducation')->with('user',$userinfo)->with('allActivity',$allActivity)->with('friends', $friends) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('education');
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
            'institute'   => 'required',
            'level'       => 'required',
            'sess'        => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with(['errors' => $validator->errors()]);
        }

        $education_basic = new Education();
        $education_basic->institute = $request->institute;
        $education_basic->sess = $request->sess;
        $education_basic->level = $request->level;
        $education_basic->major = $request->major;
        $education_basic->description = $request->description;
        $education_basic->graduate = $request->graduate !=null?"1":"0";
        //$education_basic->user_id = Auth::id();
        //dd($education_basic->graduate);
   //$education_basic->save(); 
   User::find(Auth::id())->education()->save($education_basic);
   if($education_basic->id){
       return back()->with('success','Education Updated');
   }
   else{
    return back()->with('error','Education not Updated');

   }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, education $education)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\education  $education
     * @return \Illuminate\Http\Response
     */
    public function deleteEducation($id)
    {
        Education::Where('id',$id)->delete();

            return back()->with('success','Education info deleted');
        
        }
}
