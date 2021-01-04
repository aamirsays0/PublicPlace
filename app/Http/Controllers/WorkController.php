<?php

namespace App\Http\Controllers;
use App\education;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $userinfo= User::find(['education','works'])->find(Auth::id());
       dd($userinfo);
      /* $userid = Auth::id();
      $data['work']= Work::where('user_id', $userid)->orderBy('created_at', 'desc')->get(); */
      return view('education')->with('userinfo',$userinfo);
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
            'company'   => 'required',
            'designation'       => 'required',
            'date'        => 'required',
            'description' => 'required',
            'city' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with(['errors' => $validator->errors()]);
        }
        $work_basic = new Work();
        $work_basic->company = $request->company;
        $work_basic->designation = $request->designation;
        $work_basic->workfrom = $request->date;
        $work_basic->workto = $request->date;
        $work_basic->working = $request->working !=null?"1":"0";
        $work_basic->description = $request->description;
        $work_basic->city = $request->city;

        //$work_basic->user_id = Auth::id();
        //dd($work_basic->graduate);
   //$work_basic->save(); 
   User::find(Auth::id())->works()->save($work_basic);
   if($work_basic->id){
       return back()->with('success','work Updated');
   }
   else{
    return back()->with('error','work info is not Updated');

   }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\works  $works
     * @return \Illuminate\Http\Response
     */
    public function show(works $works)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\works  $works
     * @return \Illuminate\Http\Response
     */
    public function edit(works $works)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\works  $works
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, works $works)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\works  $works
     * @return \Illuminate\Http\Response
     */
    public function deleteWork($id)
    {
        Work::Where('id',$id)->delete();

            return back()->with('success','Work info deleted');
        
        }
}
