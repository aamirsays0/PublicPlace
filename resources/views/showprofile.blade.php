<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Copied from http://mythemestore.com/friend-finder/edit-profile-basic.html by Cyotek WebCopy 1.7.0.600, Thursday, September 5, 2019, 12:34:06 AM -->
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......">
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page">
		<meta name="robots" content="index, follow">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/style.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/headerNewStyles.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/lightbox.min.css')}}" />

    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('images/fav.png')}}">
    
  </head>
  <body>
  

@include('partials.headermenu')
    <div class="container">

      <!-- Timeline
      ================================================= -->
       <div class="timeline">
      <div class="timeline-cover" style="background-image: url('{{asset('storage/profile/'.$user_information->id.'_cover.jpg')}} ')"  data-lightbox="cp">
      <div id="showcpbtncontainer">
      <span><i class ="fa fa-expand text-dark"></i></span>
     </div>
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                 @if (file_exists(public_path('storage/profile/'.$user_information->id.'_profile.jpg')) )
                    <a href="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" data-lightbox="pp">
                    <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-responsive profile-photo"/>
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo" id="uploadImage" alt="">
                   @endif
                   </a>
                  <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$user_information->id)}}" class="active">Timeline</a></li>
                  <li><a href="{{route('user.album.show',$user_information->id)}}">Album</a></li>
                  <li><a href="{{route('user.friends',$user_information->id)}}">Friends</a></li>
                </ul>
                @if($user_information->id !== Auth::user()->id)
                 <ul class="follow-me list-inline">
                  <li>
                     @if(in_array($user_information->id,$req) )
                          @if (Auth::user()->id !== $user_information->id)
                             <span class=" btn pull pull-right" style="cursor: auto;">My Friend</span>
                           @endif
                      @else
                          {{-- @if(array_search($user_information->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                            @if((array_search($user_information->id, array_column($his_friends, 'user_id')) !== false) || 
                              (array_search($user_information->id, array_column($his_friends, 'friend_id')) !== false))
                             <button class="btn pull pending pull-right" disabled>Pending</button>
                            @else 
                             <button class="btn pull addFrndBtn pull-right" data-uid="{{$user_information->id}}">Add Friend</button>
                            @endif
                       @endif
                   </li>
                  </ul>
                 @endif
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
               @if (file_exists(public_path('storage/profile/'.$user_information->id.'_profile.jpg')) )
                    <a href="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" data-lightbox="pp">
                    <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-responsive profile-photo"/>
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive profile-photo" id="uploadImage" alt="">
                   @endif
                   </a>
                   <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                  <li><a href="{{url('profiles/'.$user_information->id)}}" class="active">Timeline</a></li>
                  <li><a href="{{route('user.album.show',$user_information->id)}}">Album</a></li>
                  <li><a href="{{route('user.friends',$user_information->id)}}">Friends</a></li>
              </ul>
              @if($user_information->id !== Auth::user()->id)
                 <ul class="follow-me list-inline">
                  <li>
                     @if(in_array($user_information->id,$req) )
                          @if (Auth::user()->id !== $user_information->id)
                             <span class=" btn pull pull-right" style="cursor: auto;">My Friend</span>
                           @endif
                      @else
                          {{-- @if(array_search($user_information->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                            @if((array_search($user_information->id, array_column($his_friends, 'user_id')) !== false) || 
                              (array_search($user_information->id, array_column($his_friends, 'friend_id')) !== false))
                             <button class="btn pull pending pull-right" disabled>Pending</button>
                            @else 
                             <button class="btn pull addFrndBtn pull-right" data-uid="{{$user_information->id}}">Add Friend</button>
                            @endif
                       @endif
                   </li>
                  </ul>
                 @endif
            </div>
          </div><!--Timeline Menu for Small Screens End-->

        </div>
    
   <div id="cpmodal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">
           <img class="img-fluid img-responsive" id="modal_image_container" src="" alt="">
         </div>
     </div>
  </div>
</div>
      <div id="page-contents">
          <div class="row">
            <div class="col-md-3">
              
      
        <!--Edit Profile Menu-->
        <ul class="edit-menu " style="margin-top: 80px; display: grid;">
         <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
           <i class="icon ion-ios-information-outline"></i>
           @if ( isset($user_information) && $user_information->id === Auth::id())
           <a href="{{url('profiles')}}">Edit Basic Information</a>
           @else
           <a href="{{ route('view.friends.profile', $user_information->id) }}">  Basic Information</a>
           @endif
         </li>
         @if ( isset($user_information) && $user_information->id === Auth::id())
         <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
           <i class="icon ion-ios-information-outline"></i>
           <a href="{{ route('view.friends.profile', $user_information->id) }}">Basic Information</a>
         </li>
         @endif
           <li class='{{Route::current()->uri == 'education'?'active': ''}}'><i class="icon ion-ios-briefcase-outline"></i>
           @if ( isset($user_information) && $user_information->id === Auth::id())
           <a href="{{url('education')}}"> Education & Work</a>
           @else
           <a href="{{ route('view.friends.education', $user_information->id) }}">  Education & Work</a>
           @endif  
                 </li>
     
           <li class='{{Route::current()->uri == 'update'?'active': ''}}'>
           @if ( isset($user_information) && $user_information->id === Auth::id())
           <i class="icon ion-ios-locked-outline"></i>
             <a href="{{url('change-password')}}">  Change Password</a>
             @endif
             </li>
     
      </ul>          
    </div>
   <div class="col-md-7" style="padding-right: 30px;">

            
<!-- tabs start-->
  <br>
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
    <div class="scroll scoll-page-content">

       @forelse($posts as $userpost)

            

            <!-- Post Content
            ================================================= -->
            <div class="post-content  postid-{{$userpost->id}}">
            
              <div class="post-container">
                @if (file_exists(public_path('storage/profile/'.$userpost->user_id.'_profile.jpg')) )
                <img src="{{asset('storage/profile/'.$userpost->user_id.'_profile.jpg')}}" alt="user" class=" img-responsive profile-photo-md pull-left" />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class=" img-responsive profile-photo-md pull-left" id="uploadImage" alt="">
                   @endif
                <div class="post-detail">
                  <div class="user-info">
                    <h5>
                    <div class="profile-link1">
                    <a href="{{$userpost->user->id}}" class="profile-link">{{$userpost->user->profiles?$userpost->user->profiles->f_name.' '.$userpost->user->profiles->l_name:$userpost->user->name}}</a> 
                    <div class="friend-card1">
                        @if (file_exists(public_path('storage/profile/'.$userpost->user_id.'_cover.jpg')) )
                         <img src="{{asset('storage/profile/'.$userpost->user_id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                         @else
                         <img src="{{ asset('images/no-cover.png') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                         @endif
                        <div class="card-info">
                             @if (file_exists(public_path('storage/profile/'.$userpost->user_id.'_profile.jpg')) )
                             <img src="{{asset('storage/profile/'.$userpost->user_id.'_profile.jpg')}}" alt="user" class="profile-photo-md"/>
                             @else
                            <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="user">
                             @endif
                           <div class="friend-info">
                                  <h5><a href="{{url('profiles/'.$userpost->user_id)}}" class="profile-link">
                                   {{$userpost->user->profiles?$userpost->user->profiles->f_name.' '.$userpost->user->profiles->l_name:$userpost->user->name}}</a>
                                                     
                                      @if(in_array($userpost->user->id,$req) )
                                        @if (Auth::user()->id !== $userpost->user->id)
                                          <span class="pull pull-right">Friends</span>
                                        @endif
                                      @else
                                      {{-- @if(array_search($userpost->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                                        @if((array_search($userpost->user->id, array_column($his_friends, 'user_id')) !== false) || 
                                          (array_search($userpost->user->id, array_column($his_friends, 'friend_id')) !== false))
                                        <button class="btn pull pending pull-right" disabled>Pending</button>
                                        @else 
                                        <button class="btn pull addFrndBtn pull-right" data-uid="{{$userpost->user->id}}">Add Friend</button>
                                        @endif
                                      @endif
                                    </h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-envelope"></i>  {{$userpost->user->email}}</h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-map-marker" aria-hidden="true"></i>  {{$userpost->user->profiles?$userpost->user->profiles->city:"No city details"}}, {{$userpost->user->profiles?$userpost->user->profiles->country:"No country details"}}</h5>
                                  <h5 style="color: #7f8c8d">{{ $userpost->user->profiles?$userpost->user->profiles->description:"No Description" }}</h5>
                                <table class="tablecard">
                                    <tr>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>{{$userpost->user->posts->count()}}</b></h5>
                                          <h5 style="color: #7f8c8d">Posts</h5>
                                        </td>
                                        <td>
                                        <h5 style="color: #7f8c8d"><b>{{$userpost->user->friend->count() + $userpost->user->friends2->count()}}</b></h5>
                                          <h5 style="color: #7f8c8d">Friends</h5>
                                        </td>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>892</b></h5>
                                          <h5 style="color: #7f8c8d">Following</h5>
                                        </td>
                                    </tr>
                                </table>
                        </div>
                      </div>
                    </div>

                  </div> 

                    <span>
                    @if($userpost->privacy == 'public')
                    <i class ="ion-ios-world"></i>
                    @elseif($userpost->privacy == 'friends')
                    <i class ="fa fa-users"></i>
                    @endif
                    </span>
                    </h5>
                    <p class="text-muted">Published about {{\Carbon\Carbon::parse($userpost->created_at)->diffForHumans()}}</p>
                  </div>
                  @php
                  $reactCount = [
                   'l'=>0,
                   'd'=>0,
                   'h'=>0,
                   's'=>0,
                   'reacted'=>false,
                   'type'=>"0"

                  ];
                  $totalReactions = $userpost->reactions->count();
                  foreach($userpost->reactions as $reaction){
                    if($reaction->user_id == Auth::id()){
                      $reactCount ['type'] = $reaction->type;
                      $reactCount ['reacted'] = true;

                    }
                    $reactCount [$reaction->type]++;
                  }
                  $my_reaction = ($reactCount['reacted'])?"You and ":"";
                  if($reactCount['reacted'] && $totalReactions == 1){
                    echo "<span>Only you reacted</span>";

                  }
                  else{
                    if($reactCount['reacted']){$totalReactions--;}
                  echo "<span>".$my_reaction.$totalReactions." people reacted</span>";
                  }
                  @endphp
                  <div class="reaction" id='contentpostContainer'>
                  <a data-postid="{{$userpost->id}}" data-reaction="l" class="btn text-{{($reactCount ['type']==="l")?"primary":"secondary"}} reactionBtn"><i class="icon ion-thumbsup"></i>
                      <span class="like" >{{$reactCount['l']}}<span>
                    </a>
                    <a  data-postid="{{$userpost->id}}" data-reaction="d" class="btn text-{{($reactCount ['type']==="d")?"danger":"secondary"}} reactionBtn"><i class="fa fa-thumbs-down"></i>
                      <span class="dislike" >{{$reactCount['d']}}<span>
                    </a>
                    <a data-postid="{{$userpost->id}}" data-reaction="h" class="btn text-{{($reactCount ['type']==="h")?"success":"secondary"}} reactionBtn"><ion-icon name="heart"></ion-icon>
                      <span class="heart" >{{$reactCount['h']}}</span>
                    </a>
                    <a  data-postid="{{$userpost->id}}" data-reaction="s" class="btn text-{{($reactCount ['type']==="s")?"success":"secondary"}} reactionBtn"><ion-icon name="happy"></ion-icon> 
                      <span class="smiled">{{$reactCount['s']}}</span>
                    </a>
                    <a href="{{ route('posts.show', $userpost->id) }}" class="btn btn-info fa fa-eye"></a>

                    @if($userpost->user_id == Auth::id())
                    {!! Form::open(['url' => 'posts/'.$userpost->id,'method' => 'delete','class' => 'btn d-inline', 'id' => 'delete-button']) !!}
                    <button class="btn btn-danger fa fa-trash"></button>
                    {!! Form::close() !!}                   
                    <!-- DELETE ICON -->
                    <!--<a href={{url('post'.'/'.$userpost->id) }}" onclick="event.preventDefault(); document.getElementById('delete-post').submit();" class="fa fa-trash"></a><form id="delete-post" action="{{ url('post'.'/'.$userpost->id)}}" method="DELETE" style="display: none;"@csrf</form>-->
                    @endif

                    
                  </div>
                  <div class="post-text">
                    <p>{{$userpost->content}}</p>
                    <hr>
                    <div id="carouselControls" class="carousel slide" data-ride="carousel">
 
                        <ol class="carousel-indicators">
                         @foreach($userpost->pictures as $pic)
                            <li data-target="#carouselIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                         @endforeach
                        </ol>
                       
                 <div class="carousel-inner" role="listbox">
                    @forelse($userpost->pictures as $pic)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <?php
                    $imageinfo = pathinfo(url('/storage/postimages/'.$pic->imgname));
                    //print_r($imageinfo);
                    ?>
                    <a href="{{url('/storage/postimages/'.$pic->imgname)}}" data-lightbox="imageset-{{$userpost->id}}">
                    <img src=" {{url('/storage/postimages/'.$imageinfo['filename'].".".$imageinfo['extension'])}}" alt="" class="d-block w-80">
                    </a>
                    </div>

                    @empty

                    @endforelse
                    </div>
                    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                </div>

                    @if (isset($userpost->videos[0]))
                   <video width="320" height="240" controls>
                    <source src="{{ asset('storage/postvideos/'.$userpost->videos[0]->vidname) }}" type="video/mp4">
                    Your browser does not support the video tag.
                  </video> 
                  @endif
                   
                  </div>
               <div class="viewpost"><a href="javascript:void(0)" class="commentToggleBtn">{{$userpost->comments->count()}} <span><i class="fa fa-comment" style="font-size: 18px;"></i></span></a>
                <div class="comment-widgets m-b-20 commentContainer" style="display: none;">
                   @forelse($userpost->comments as $usercomment)
                    <div class="d-flex flex-row comment-row"style="padding-left: 0px; cursor: auto;">
                        <div class="p-2"><span class="round"><img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')}}" class="profile-photo-sm" alt="user" width="50"></span></div>
                        <div class="comment-text w-100">
                            <h5>
                              <div class="profile-link1">
                               <a href="{{url('profiles/'.$usercomment->user->id)}}" class="profile-link">{{$usercomment->user->profiles?$usercomment->user->profiles->f_name.' '.$usercomment->user->profiles->l_name:$usercomment->user->name}}</a>
                                    <div class="friend-card1">
                                        @if (file_exists(public_path('storage/profile/'.$usercomment->user_id.'_cover.jpg')) )
                                        <img src="{{asset('storage/profile/'.$usercomment->user_id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                                        @else
                                        <img src="{{ asset('images/no-cover.png') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                                        @endif
                                        <div class="card-info">
                                            @if (file_exists(public_path('storage/profile/'.$usercomment->user_id.'_profile.jpg')) )
                                            <img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile.jpg')}}" alt="user" class="profile-photo-md"/>
                                            @else
                                            <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="user">
                                            @endif
                                          <div class="friend-info">
                                                  <h5><a href="{{url('profiles/'.$usercomment->user_id)}}" class="profile-link">
                                                  {{$usercomment->user->profiles?$usercomment->user->profiles->f_name.' '.$usercomment->user->profiles->l_name:$usercomment->user->name}}</a>
                                                                    
                                                      @if(in_array($usercomment->user->id,$req) )
                                                        @if (Auth::user()->id !== $usercomment->user->id)
                                                          <span class="pull pull-right">Friends</span>
                                                        @endif
                                                      @else
                                                      {{-- @if(array_search($usercomment->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                                        @if((array_search($usercomment->user->id, array_column($his_friends, 'user_id')) !== false) || 
                                          (array_search($usercomment->user->id, array_column($his_friends, 'friend_id')) !== false))
                                                        <button class="btn pull pending pull-right" disabled>Pending</button>
                                                        @else 
                                                        <button class="btn pull addFrndBtn pull-right" data-uid="{{$usercomment->user->id}}">Add Friend</button>
                                                        @endif
                                                      @endif
                                                    </h5>
                                                  <h5 style="color: #7f8c8d"><i class="fa fa-envelope"></i>  {{$usercomment->user->email}}</h5>
                                                  <h5 style="color: #7f8c8d"><i class="fa fa-map-marker" aria-hidden="true"></i>  {{$usercomment->user->profiles?$usercomment->user->profiles->city:"No city details"}}, {{$usercomment->user->profiles?$usercomment->user->profiles->country:"No country details"}}</h5>
                                                  <h5 style="color: #7f8c8d">{{ $usercomment->user->profiles?$usercomment->user->profiles->description:"No Description" }}</h5>
                                                <table class="tablecard">
                                                    <tr>
                                                        <td>
                                                          <h5 style="color: #7f8c8d"><b>{{$usercomment->user->posts->count()}}</b></h5>
                                                          <h5 style="color: #7f8c8d">Posts</h5>
                                                        </td>
                                                        <td>
                                                          <h5 style="color: #7f8c8d"><b>{{$usercomment->user->friend->count() + $usercomment->user->friends2->count()}}</b></h5>
                                                          <h5 style="color: #7f8c8d">Friends</h5>
                                                        </td>
                                                        <td>
                                                          <h5 style="color: #7f8c8d"><b>892</b></h5>
                                                          <h5 style="color: #7f8c8d">Following</h5>
                                                        </td>
                                                    </tr>
                                                </table>
                                        </div>
                                      </div>
                                    </div>
                
                                  </div> 
                             
                             </h5>
                            <div class="comment-footer"> <span class="date">{{\Carbon\Carbon::parse($usercomment->created_at)->diffForHumans()}}</span>
                              @if (Auth::check())
                                @if(count((array) $userpost->comments) > 0)
                                @if($usercomment->user->id == Auth::user()->id)
                                {!! Form::open(['url' => 'deleteComment/'.$usercomment->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment','style' => 'position: absolute; right: 0%']) !!}
                                   <span class="label label-danger deleteComment"><i class="fa fa-trash"></i></span>
                                   {!! Form::close() !!}
                                @endif
                                @endif
                               @endif
                            <!-- <span class="action-icons"> <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i class="fa fa-rotate-right"></i></a> <a href="#" data-abc="true"><i class="fa fa-heart"></i></a> </span> -->
                          </div>
                            <p class="m-b-5 m-t-10"style="padding-right: 25px;">{{$usercomment->comment}}</p>
                        </div>
                    </div>
                    @empty
                  <h5>No comments added yet</hf>
                  @endforelse
                    </div>
                  <a href="javascript:void(0)" class="postcommentToggleBtn"><span><i class="ion-compose ion-icons-colors" style="font-size: 18px; position:absolute; right:65%; "></i></span></a>
                  <div class="postcommentContainer" style="display: none;">
                  <div class="post-comment">
                    @if (file_exists(public_path('storage/profile/'.Auth::id().'_profile_thumb.jpg')) )
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-sm" id="uploadImage" alt="">
                   @endif
                    {!! Form::open([
                    'route'=> ['posts.comment',$userpost->id],
                      'class'=>'form']) !!}
                    <div class="form-group">
                    <input type="text" name="postcomment" class="form-control" placeholder="Post a comment">
                    <button class="btn btn-light form-control" style="  border: 1px solid grey;" type="submit" name="commentBtn">Comment</button>
                    </div>
                    {!! Form::close() !!}
                   </div>
                   </div>
                </div>
                    </div>
              </div>
            </div>
       @empty
       <h3>No posts avaliable</h3>
        @endforelse

        <div class="col-12 scroll-page-pagination">
          {{ $posts->links() }}
        </div>

                    </div>
      </div>
      
        <div class="col-md-2 static">
          <div id="sticky-sidebar">
          @if($user->id == Auth::id())
          <h4 class="grey">Your activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                  @if($activity->type == "post")
                  <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You added a Post</a>
                  @else
                    @if($activity->user->id == $activity->post->user->id)
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You {{ $activity->type }}ed on your Post</a>
                    @else
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? $activity->post->user->profiles->f_name : $activity->post->user->name }}</a>
                    @endif 
                  @endif 
                  </p>
                  <p class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                </div>
              </div>
            @endforeach          
           @else
           <h4 class="grey">{{ isset($user->profiles->f_name) ? ucfirst($user->profiles->f_name) : ucfirst($user->name) }}'s Activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                  @if($activity->type == "post")
                  <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} added a Post</a>
                  @else
                      @if($activity->user->id == $activity->post->user->id)
                       <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on his Post</a>
                       @else
                         <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on a Post</a>                   
                         <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? $activity->post->user->profiles->f_name : $activity->post->user->name }}</a>
                       @endif   
    
                  @endif   
                  </p>
                  <p class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                </div>
              </div>
            @endforeach          

           @endif
           </div>
        </div>
</div>
</div>
    <!-- Footer
    ================================================= -->
    @include('partials.footer')
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

    <!-- Scripts
    ================================================= -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.sticky-kit.min.js')}}"></script>
    <script src="{{asset('js/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/lightbox.min.js')}}"></script>
    <script src="{{asset('js/jquery.jscroll.min.js')}}"></script>
    <script src="http://unpkg.com/ionicons@4.4.2/dist/ionicons.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Sweet alert CDN -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#showcpbtncontainer").click(function(){
          var url = ($(".timeline-cover").css('background-image'));
          var start_quot = url.indexOf("\"") + 1;
          var end_quot = url.lastIndexOf("\"");
          url=(url.substring(start_quot,end_quot));
          $('#modal_image_container').attr("src",url);
          $('#cpmodal').modal();
          //location.reload();
        });
      })
    </script>
    <script>
 Pusher.logToConsole = true;
 var pusher = new Pusher ('0e8a23a77d5e825ac0fc', {
   cluster: 'ap2',
   useTLS: true
   
 }
 );
 /* var channel = pusher.subscribe('Public-Place'); */
 var channel = pusher.subscribe('user-{{Auth::id()}}');
 
 channel.bind('new-post', function(data){
   if (data.sender_id === {{ Auth::id() }}) return;
   //alert(data.message);
   if (data.type == "post"){
  var template = '<a href="{{url('posts/')}}/'+data.pid+'" class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h5 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h5><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
              }
  else if(data.type == "reaction"){
    var template = '<a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h5 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h5><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
  }


         
  $("#notificationDropdown span.count").text(
    parseInt($("#notificationDropdown span.count").text())
    +1);

  
  $("#noteItemContainer").prepend(template);
 });
</script>
<script>
    var form_data = new FormData();
 
var storedFiles = [];
    $(document).ready(function(e){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });
       // ADD FRIEND START//
$(".user-info").on("click",".addFrndBtn",function(){
   var url = '{{URL::to('/')}}' +"/addfriend/" +$(this).data('uid');
   swal({
          title: "Are you sure?",
          text: "Once added, Request will be sent",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
                         
             $.ajax({
                   method: "POST",
                   url:url,
                   cache: false,
                   data:{r:Math.random()}
                 }).done(function(data){
                   console.log(data);
                   if(data.success){
                     swal("Request sent", data.message, 'success');
                     location.reload();
                 //RESET FORM AFTER POST
                    // $('postform').trigger("reset");
                     //$(".preview").html("");
                   }
                   //console.log(data);
                 }).fail(function(data){
                   console.log(data);
                   alert(data.message);
                 });
         
          } else {
            swal("Cancelled", "User in not added as friend", "error");
          }
        });




 });
// ADD FRIEND END//
       // ADD FRIEND ON BAR//
       $(".follow-me").on("click",".addFrndBtn",function(){
   var url = '{{URL::to('/')}}' +"/addfriend/" +$(this).data('uid');
   swal({
          title: "Are you sure?",
          text: "Once added, Request will be sent",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
                         
             $.ajax({
                   method: "POST",
                   url:url,
                   cache: false,
                   data:{r:Math.random()}
                 }).done(function(data){
                   console.log(data);
                   if(data.success){
                     swal("Request sent", data.message, 'success');
                     location.reload();
                 //RESET FORM AFTER POST
                    // $('postform').trigger("reset");
                     //$(".preview").html("");
                   }
                   //console.log(data);
                 }).fail(function(data){
                   console.log(data);
                   alert(data.message);
                 });
         
          } else {
            swal("Cancelled", "User in not added as friend", "error");
          }
        });




 });
// ADD FRIEND ON BAR END//

//reaction start
$(".reaction").on("click",".reactionBtn", function(){
      var url = '{{URL::to('/')}}' +"/react";
      //alert(url);
       //$postid = $(this).data('postid');
      // $reactionid = $(this).data('reaction');
      // alert($postid + ":" + $reactionid);
//ajax start
$.ajax({
          method: "POST",
          url:url,
          /* cache: false,
          contentType: false,
          processData: false, */
          data:{
            'postid': $(this).data('postid'),
            'react': $(this).data('reaction'),
            r:Math.random()},
        success: (data) =>  {
          console.log($(this).data('postid'), "INSIDE AJHAX")
        }
        }
        ).done((data) => {
        //  console.log(data);
         // return;
          if(data.success){
            //alert(data.message);
            $(this).parent().find('.like').html(data.liked);
            $(this).parent().find('.smiled').html(data.smiled) ;
            $(this).parent().find('.heart').html(data.loved);
            $(this).parent().find('.dislike').html(data.disliked)
            if (data.liked <= 0) {
              $(this).parent().find('.like').parent().removeClass('text-primary')
              // $('#like').parent().removeClass('text-primary')
              $(this).parent().find('.like').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.like').parent().removeClass('text-secondary')
              $(this).parent().find('.like').parent().addClass('text-primary')
            }
            //
            if (data.smiled <= 0) {
              $(this).parent().find('.smiled').parent().removeClass('text-primary')
              $(this).parent().find('.smiled').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.smiled').parent().removeClass('text-secondary')
              $(this).parent().find('.smiled').parent().addClass('text-primary')
            }
            //
            if (data.loved <= 0) {
              $(this).parent().find('.heart').parent().removeClass('text-primary')
              $(this).parent().find('.heart').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.heart').parent().removeClass('text-secondary')
              $(this).parent().find('.heart').parent().addClass('text-primary')
            }
            //
            if (data.disliked <= 0) {
              $(this).parent().find('.dislike').parent().removeClass('text-primary')
              $(this).parent().find('.dislike').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.dislike').parent().removeClass('text-secondary')
              $(this).parent().find('.dislike').parent().addClass('text-primary')
            }

          }
          //console.log(data);
        }).fail(function(data){
          alert(data.message);
        });
 //ajax end

     });  
//reaction ends
//comment container show hide start
          $(".viewpost").on("click",".commentToggleBtn", function(){
            $(this).next(".commentContainer").toggle(250);

          });
//comment container show hide end
//post comment container show hide start
$(".viewpost").on("click",".postcommentToggleBtn", function(){
            $(this).next(".postcommentContainer").toggle(250);

          });
//post comment container show hide end

    });
          document.querySelector('#delete-button').addEventListener('submit', function(e) {
            var form = this;
            
            e.preventDefault();
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, post cannot be recovered",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,
              }).then(function(isConfirm) {
                if (isConfirm) {
                  form.submit();
      
                }
              });
          });
          $('.deleteComment').click(function (e){
              e.preventDefault();
              let form = $(this).parents('form');
              swal({
                  title: 'Are you sure?',
                  text: 'Once deleted, Comment cannot be recovered',
                  icon: 'warning',
                  buttons: ["Cancel it", "Yes, sure"],
                  dangerMode: true,
              }).then(function(value) {
                  if(value){
                      form.submit();
                  }
              });
          })
          
    </script>


  </body>
</html>
