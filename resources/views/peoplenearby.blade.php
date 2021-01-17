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
            	<img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="user" class="profile-photo" />
            	<h5><a href="{{url('profiles/'.Auth::id())}}" title="{{ isset(Auth::user()->profiles->f_name) ? Auth::user()->profiles->f_name.' '.Auth::user()->profiles->l_name: Auth::user()->name}}" class="text-white">{{ isset(Auth::user()->profiles->f_name) ? Auth::user()->profiles->f_name.' '.Auth::user()->profiles->l_name: Auth::user()->name}}</a></h5>
            	<a href="{{url('friends/'.Auth::id())}}" class="text-white" title="{{$friends->count()-1}} Friends"><i class="ion ion-android-person-add"></i>{{$friends->count()-1}} Friends</a>
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
                @if($friend->id != Auth::id())
                <li class="list-inline-item"><a href="{{url('profiles/'.$friend->id)}}" title="{{$friend->name}}">
                @if (file_exists(public_path('storage/profile/'.$friend->id.'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.$friend->id.'_profile.jpg')}}" alt="" class="profile-photo-md " />
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
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="tab-content tab-pane active"><br>
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
  </div>
<!-- tabs end -->
@endsection

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
  @section('sidebar-right')
          <div class="suggestions" id="sticky-sidebar">
          @include('partials.friendrequests')
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
 
 $("#home").on("click",".addFrndBtn",function(){
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
