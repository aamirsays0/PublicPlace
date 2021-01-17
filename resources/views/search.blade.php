@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
     .singleImage{
       position:relative;
     }
     .singleImage span{
       position:absolute;
       top:-10px;
       right:-10px;
       border-radius:50%;
     }
@endpush


@section('sidebar-left')
          <div class="profile-card" style="background-image: url('{{asset('storage/profile/'.Auth::id().'_cover.jpg')}} ');">
            	
          @if (file_exists(public_path('storage/profile/'.Auth::id().'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="profile-photo-md " />
                    @else
                       <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="">
                    @endif
          	<h5><a href="{{url('profiles/'.Auth::id())}}" title="{{ isset(Auth::user()->profiles->f_name) ? Auth::user()->profiles->f_name.' '.Auth::user()->profiles->l_name: Auth::user()->name}}" class="text-white">{{ isset(Auth::user()->profiles->f_name) ? Auth::user()->profiles->f_name.' '.Auth::user()->profiles->l_name: Auth::user()->name}}</a></h5>
            	<a href="{{url('friends/'.Auth::id())}}" class="text-white" title="{{$friends->count()}} Friends"><i class="ion ion-android-person-add"></i>{{$friends->count()}} Friends</a>
            </div><!--profile card ends-->
            <ul class="nav-news-feed">
              <li><i class="icon ion-ios-paper"></i><div><a href="newsfeed.html">My Newsfeed</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="{{url('friends/'.Auth::id())}}">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="{{url('chat')}}">Messages</a></div></li>
              <li><i class="icon ion-images"></i><div><a href="{{url('image/'.Auth::id())}}">Images</a></div></li>
              <li><i class="icon ion-ios-videocam"></i><div><a href="newsfeed-videos.html">Videos</a></div></li>
            </ul><!--news-feed links ends-->
            <div id="friends-block">
            <a href="{{url('friends/'.Auth::id())}}"><button type="button" class="ftitle">Friends</button></a>
              <hr>
              <ul class="online-users list-inline list-unstyled">
              @forelse($friends as $friend)
                @if($friend->friendInfo->id != Auth::id())
                <li class="list-inline-item"><a href="{{url('profiles/'.$friend->friendInfo->id)}}" title="{{$friend->friendInfo->name}}">
                @if (file_exists(public_path('storage/profile/'.$friend->friendInfo->id.'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.$friend->friendInfo->id.'_profile.jpg')}}" alt="" class="profile-photo-md " />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="">
                   @endif
                   </a></li>
                 
                 @endif
                 @empty
              <h3>no friends yet, search for new friends</h3>
              @endforelse 
              </ul>
              
            </div><!--Friends block ends-->
            <div id="chat-block">
            <button class="ctitle">Chat online</button>
              <ul class="online-users list-inline list-unstyled">
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Linda Lohan"><img src="images/users/user-2.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Sophia Lee"><img src="images/users/user-3.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="John Doe"><img src="images/users/user-4.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Alexis Clark"><img src="images/users/user-5.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="James Carter"><img src="images/users/user-6.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Robert Cook"><img src="images/users/user-7.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Richard Bell"><img src="images/users/user-8.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Anna Young"><img src="images/users/user-9.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Julia Cox"><img src="images/users/user-10.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
              </ul>
            </div><!--chat block ends-->
 @endsection
 @section('content')
                @if ($message = Session::get('success'))
              <div class="alert alert-success" id="errorcontainer">
              <h3>{{$message}}</h3>
              </div>
              @endif
<!-- tabs start-->
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">People</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Posts</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="tab-content tab-pane active"><br>
      <h3>People Search Results</h3>
      <div class="people-nearby">
      @forelse($users as $user)
       <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                  @if (file_exists(public_path('storage/profile/'.$user->id.'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}"  alt="user" class="profile-photo-lg" />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-lg" id="uploadImage" alt="">
                   @endif
                  </div>

                  <div class="col-md-7 col-sm-7">

                    <h5><a href="{{url('profiles/'.$user->id)}}" class="profile-link">{{$user->profiles?$user->profiles->f_name.' '.$user->profiles->l_name:$user->name}}</a></h5>
                    <p style="font-size: 1.7rem;">{{$user->email}}</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    @if(in_array($user->id,$req))
                    @if (Auth::user()->id !== $user->id)
                        <span class="pull">Friends</span>
                      @endif
                    @else
                      @if($his_friends->where('friend_id', $user->id)->where('approved', 0)->where('blocked', 0)->first())
                      <button class="btn pull pending" disabled>Pending</button>
                      @else 
                      <button class="btn pull addFrndBtn" data-uid="{{$user->id}}">Add Friend</button>
                      @endif
                    @endif
                  </div>

                </div>
         </div>
          @empty
          @endforelse
      
      
    </div>
    
  </div>
  <div id="menu1" class="tab-content tab-pane"><br>
  <div class="scroll">
       @forelse($posts as $post)

            

            
            <div class="post-content  postid-{{$post->id}}">
            
              <div class="post-container">
                <img src="{{asset('storage/profile/'.$post->user_id.'_profile.jpg')}}" alt="user" class=" img-responsive profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5>

                    <a href="{{url('profiles/'.$post->user->id)}}" class="profile-link">{{$post->user->profiles?$post->user->profiles->f_name.' '.$post->user->profiles->l_name:$post->user->name}}</a> 
                    <span>
                    @if($post->privacy == 'public')
                    <i class ="ion-ios-world"></i>
                    @elseif($post->privacy == 'friends')
                    <i class ="fa fa-users"></i>
                    @endif
                    </span>
                   
                    @if(in_array($post->user->id,$req) )
                      @if (Auth::user()->id !== $post->user->id)
                        <span class="pull">Friends</span>
                      @endif
                    @else
                      @if($friends->where('friend_id', $post->user->id)->where('approved', 0)->first())
                      <button class="btn pull pending" disabled>Pending</button>
                      @else 
                      <button class="btn btn-primary pull-right addFrndBtn1" data-uid="{{$post->user->id}}">Add Friend</button>
                      @endif
                    @endif</h5>
                    <p class="text-muted">Published about {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
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
                  $totalReactions = $post->reactions->count();
                  foreach($post->reactions as $reaction){
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
                  <div class="reaction">
                    <a data-postid="{{$post->id}}" data-reaction="l" class="btn text-{{($reactCount ['type']==="l")?"primary":"secondary"}} reactionBtn"><i class="icon ion-thumbsup"></i>
                      <span class="like" >{{$reactCount['l']}}<span>
                    </a>
                      <!--<a data-postid="{{$post->id}}" data-reaction="l" class="btn text-success reactionBtn"><i class="icon ion-thumbsup"></i>0</a> -->
                    <a  data-postid="{{$post->id}}" data-reaction="d" class="btn text-{{($reactCount ['type']==="d")?"danger":"secondary"}} reactionBtn"><i class="fa fa-thumbs-down"></i>
                      <span class="dislike" >{{$reactCount['d']}}<span>
                    </a>
                      <!--<a data-postid="{{$post->id}}" data-reaction="d" class="btn text-danger reactionBtn"><i class="fa fa-thumbs-down"></i> 0</a> -->
                    <a data-postid="{{$post->id}}" data-reaction="h" class="btn text-{{($reactCount ['type']==="h")?"success":"secondary"}} reactionBtn"><ion-icon name="heart"></ion-icon>
                      <span class="heart" >{{$reactCount['h']}}</span>
                    </a>
                      <!--<a data-postid="{{$post->id}}" data-reaction="h" class="btn text-success reactionBtn"><ion-icon name="heart"></ion-icon>0</a> -->
                    <a  data-postid="{{$post->id}}" data-reaction="s" class="btn text-{{($reactCount ['type']==="s")?"success":"secondary"}} reactionBtn"><ion-icon name="happy"></ion-icon> 
                      <span class="smiled">{{$reactCount['s']}}</span>
                    </a>
                       <!--<a data-postid="{{$post->id}}" data-reaction="s" class="btn text-success reactionBtn"><ion-icon name="happy"></ion-icon> 0</a> -->
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info fa fa-eye"></a>

                    @if($post->user_id == Auth::id())
                    {!! Form::open(['url' => 'posts/'.$post->id,'method' => 'delete','class' => 'btn d-inline']) !!}
                    <button class="btn btn-danger fa fa-trash" onclick="return confirm('are sure you want to delete this post?')"></button>

                    {!! Form::close() !!}                   
                    @endif

                    
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{$post->content}}</p>
                    <hr>
                    @forelse($post->pictures as $pic)
                    <?php
                    $imageinfo = pathinfo(url('/storage/postimages/'.$pic->imgname));
                    //print_r($imageinfo);
                    ?>
                    <a href="{{url('/storage/postimages/'.$pic->imgname)}}" data-lightbox="imageset-{{$post->id}}">
                    <img src=" {{url('/storage/postimages/'.$imageinfo['filename'].".".$imageinfo['extension'])}}" alt="" width="120px">
                    </a>
                    @empty

                    @endforelse
                    @forelse($post->videos as $vid)
                    <?php
                    $vidinfo = pathinfo(url('/storage/postimages/'.$vid->vidname));
                    //print_r($imageinfo);
                    ?>
                    <a href="{{url('/storage/postimages/'.$vid->vidname)}}" data-lightbox="imageset-{{$post->id}}">
                    <img src=" {{url('/storage/postimages/'.$vidinfo['filename'].".".$vidinfo['extension'])}}" alt="" width="120px">
                    </a>
                    @empty

                    @endforelse
                    
                  </div>
                  <div class="line-divider"></div>
                  <div class="viewpost"><a href="javascript:void(0)" class="commentToggleBtn">{{$post->comments->count()}} 
                    <span><i class="fa fa-comment" style="font-size: 18px;"></i></span>
                  </a>
                  <div class="commentContainer" style="display: none;">
                   @forelse($post->comments as $usercomment)
                    <div class="post-comment">
                    <img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                    <p><a href="{{url('profiles/'.$usercomment->user->id)}}" class="profile-link">{{$usercomment->user->profiles?$usercomment->user->profiles->f_name.' '.$usercomment->user->profiles->l_name:$usercomment->user->name}}</a>
                    <i class="em em-laughing"></i>{{$usercomment->comment}}</p>
                    @if (Auth::check())
                    @if(count((array) $post->comments) > 0)
                    @if($usercomment->user->id == Auth::user()->id)
                    {!! Form::open(['url' => 'deleteComment/'.$usercomment->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment']) !!}
                    <button class="btn btn-danger fa fa-trash" onclick="return confirm('are sure you want to delete this comment?')"></button>
                    {!! Form::close() !!}
                    @endif
                    @endif
                    @endif

                  </div>
                  @empty
                  <h5>No comments added yet</hf>
                  @endforelse
                  </div>
                  <a href="javascript:void(0)" class="postcommentToggleBtn"><span><i class="ion-compose ion-icons-colors" style="font-size: 18px; position:absolute; right:65%; "></i></span></a>
                  <div class="postcommentContainer" style="display: none;">
                  <div class="post-comment">
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                    {!! Form::open([
                    'route'=> ['posts.comment',$post->id],
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
        </div> 
    </div>
  </div>
<!-- tabs end -->
@endsection

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
  @section('sidebar-right')
          <div class="suggestions" id="sticky-sidebar">
              <h4 class="grey" style="font-weight: 600;">Friend Requests</h4>
              <hr>
              @forelse($requests as $req)
               <div class="follow-user">
                <img src="{{asset('storage/profile/'.$req->user_id.'_profile.jpg')}}" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h6><a href="{{url('profiles/'.$req->user->id)}}">{{isset($req->user->profiles->f_name, $req->user->profiles->l_name)? $req->user->profiles->f_name.' '. $req->user->profiles->l_name: $req->user->name}}</a></h6>
                  <a class="confirmBtn text-green" data-uid="{{$req->user_id}}" href="javascript:void(0)">Confirm</a>
                  <a class="deleteBtn text-danger" data-uid="{{$req->id}}"  href="javascript:void(0)">Delete</a>
                </div>
               </div>
              @empty
              <h5>No Friend Requests</h5>
              @endforelse
             
             </div>
@endsection

@section("script")
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>
     $(document).ready(function(e){
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });
 
 $(".nearby-user").on("click",".addFrndBtn",function(){
   var url = '{{URL::to('/')}}' +"/addfriend/" +$(this).data('uid');
   $.ajax({
          method: "POST",
          url:url,
          cache: false,
          data:{r:Math.random()}
        }).done(function(data){
          console.log(data);
          if(data.success){
            alert(data.message);
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



 });
 
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


            // location.reload();
            
        //RESET FORM AFTER POST
            //$('postform').trigger("reset");
            //$(".preview").html("");
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
    </script>
    @endsection
  </body>
</html>
