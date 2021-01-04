<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use App\Message;
use App\Post;
use App\Picture;
use App\Friend;
use App\Custom\FriendsList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Pusher\Pusher;
use App\Custom\Push;
class ChatController extends Controller
{
    private $p;
   
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
        );    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = FriendsList::Friends(Auth::id());
        $users = User::with(['profiles'])->whereIn('id', $friends)->get();
        return view('chat')->with('users',$users);
        // $friends = User::with('profiles')
        // ->whereIn('id',$friends)
        //  ->get();
        // $searchResult = User::with('profiles', 'friends')
        // ->where('name', 'like', '%'.$request->search.'%')
        // ->orWhere('email','like', '%'.$request->search.'%')
        // ->orderBy('name')
        // ->get();
        // return view('chat')->with('sResult', $searchResult)->with('friends', $friends);
    }
    public function fetchMessages(){
        return Message::with('user')->get();
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
    public function chatHistory(Request $request){
        $first = DB::table('chats')
                ->where('user_id',Auth::id())
                ->where('friends_id', $request->id);

        $allChats = DB::table('chats')
                ->where('friends_id',Auth::id())
                ->where('user_id', $request->id)
                ->union($first)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        $allChats = $allChats->reverse()->values();
        return response()->json($allChats);
    }
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->chats()->create([

            'message'=> $request->input('m'),
            'friends_id'=> $request->input('fid')
        ]);
            $data['chatmessage'] = $request->input('m');
            $data['type'] = 'message';
            $data['pid'] = $message->id;
            $data['mtime'] = $message->created_at;
            $data['user_id'] = Auth::id();
            $data['user_name'] = $user->name;
       // broadcast( new MessagesSent($user, $message))->toOthers();
       $this->p->trigger('user-'. $request->input('fid'), 'new-post', $data); 
       $this->p->trigger('user-'. Auth::id(), 'new-post', $data); 
       return response()->json(['status' => 'Message Sent !','mid'=>$message->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
