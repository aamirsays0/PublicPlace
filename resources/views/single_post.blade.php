@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
@endpush


@section('sidebar-left')
    @include('partials.leftSidebar')
@endsection

@section('content')
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            <!-- Post Content
            ================================================= -->
            <div class="post-content  postid-{{$userpost->id}}" style="overflow: unset">            
              <div class="post-container">
                   @if (file_exists(public_path('storage/profile/'.$userpost->user_id.'_profile.jpg')) )
                   <img src="{{asset('storage/profile/'.$userpost->user_id.'_profile.jpg')}}" alt="user" class=" img-responsive profile-photo-md pull-left" />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class=" img-responsive profile-photo-md pull-left" id="uploadImage" alt="user">
                    @endif
                <div class="post-detail">
                  <div class="user-info">
                    <h5>
                    <div class="profile-link1">
                    <a href="{{url('profiles/'.$userpost->user->id)}}" class="profile-link">{{$userpost->user->profiles?$userpost->user->profiles->f_name.' '.$userpost->user->profiles->l_name :$userpost->user->name}}</a> 
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
                            <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="">
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
                                        <h5 style="color: #7f8c8d">{{ $userpost->user->reactions()->count() }}</h5>
                                          <h5 style="color: #7f8c8d">Likes</h5>
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
                    @if(in_array($userpost->user->id,$req) )
                      @if (Auth::user()->id !== $userpost->user->id)
                        <span class="pull">Friends</span>
                      @endif
                    @else
                    {{-- @if(array_search($userpost->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                          @if((array_search($userpost->user->id, array_column($his_friends, 'user_id')) !== false) || 
                            (array_search($userpost->user->id, array_column($his_friends, 'friend_id')) !== false))
                      <button class="btn pull pending" disabled>Pending</button>
                      @else 
                      <button class="btn pull addFrndBtn" data-uid="{{$userpost->user->id}}">Add Friend</button>
                      @endif
                    @endif</h5>
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
                    {!! Form::open(['url' => 'post/'.$userpost->id,'method' => 'delete','class' => 'btn d-inline', 'id' => 'delete-button']) !!}
                    @if($userpost->user_id == Auth::id())

                    <button class="btn btn-danger fa fa-trash"></button>
                    @endif

                    {!! Form::close() !!}                   

                    
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{$userpost->content}}</p>
                    <hr>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                       @foreach($userpost->pictures as $pic)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
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
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
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
                  <div class="line-divider"></div>
                  <div class="postcommentContainer">
                  <div class="post-comment">
                     @if (file_exists(public_path('storage/profile/'.Auth::id().'_cover.jpg')) )
                         <img src="{{asset('storage/profile/'.Auth::id().'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                         @else
                         <img src="{{ asset('images/noimage.jpg') }}"  class="profile-photo-sm" id="uploadImage"  alt="" />
                         @endif                    
                    <div class="form-group w-100">
                    <input type="text" name="postcomment" class="form-control" id="comment" placeholder="Post a comment">
                    </div>
                   </div>
                   </div>

                  <div class="viewpost"><a class="">{{$userpost->comments->count()}} Comments</a>
                  <div class="comment-widgets m-b-20 commentContainer">
                   @forelse($userpost->comments as $usercomment)
                    <div class="d-flex flex-row comment-row"style="padding-left: 0px; cursor: auto;">
                        <div class="p-2"><span class="round">
                             @if (file_exists(public_path('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')) )
                               <img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')}}" class="profile-photo-sm" alt="user" width="50">
                              @else
                                <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-sm" id="uploadImage" alt="user">
                              @endif
                        </span></div>
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
                                                        <h5 style="color: #7f8c8d">{{ $usercomment->user->reactions()->count() }}</h5>
                                                          <h5 style="color: #7f8c8d">Likes</h5>
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
                </div>
                    </div>
                    </div>
              </div>


@endsection

@section('sidebar-right')
<div class="suggestions" id="sticky-sidebar">
   @include('partials.friendrequests')
           
 </div>
@endsection

@section("script")
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
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
   //alert(data.message);
   if (data.type == "post"){
  var template = '<a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h6><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
              }
  else if (data.type == "reactions"){
    var template = '<a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h6><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
  }
         
  $("#notificationDropdown span.count").text(
    parseInt($("#notificationDropdown span.count").text())
    +1);
  $("#noteItemContainer").prepend(template);
  $.ajax({
        method: "GET",
        url:"{{ route('notification.show', auth()->id()) }}",
        success: function(res) {
          console.log("Notifications", res.notifications.notifications)
          parseInt($("#notificationDropdown span.count").text(res.notifications.notifications));
        },
        error: function(err) {
          console.log(err)
        }

      });
 });

 $(document).ready(function() {
  $.ajax({
        method: "GET",
        url:"{{ route('notification.show', auth()->id()) }}",
        success: function(res) {
          console.log("Notifications", res.notifications.notifications)
          parseInt($("#notificationDropdown span.count").text(res.notifications.notifications));
        },
        error: function(err) {
          console.log(err)
        }

      });
 })
</script>
<script>
    var form_data = new FormData();
 

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
                  swal("Request Sent", data.message, 'success');

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

//CONFIRM FRIEND REQUEST
//CONFIRM FRIEND 
$(".confirmBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/confirmfriend/"+f;
             swal({
          title: "Are you sure?",
          text: "Once confirmed, This user will be your friend",
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
                  contentType: false,
                  processData: false,
                  data:{r:Math.random()}
                }).done(function(data){
                // console.log(data);
                // return;
                  if(data.success){
                    swal("Successful", data.message, "success");
                    t.parent().parent().remove();

                  // location.reload();
                    
                //RESET FORM AFTER POST
                    //$('postform').trigger("reset");
                    //$(".preview").html("");
                  }
                  //console.log(data);
                }).fail(function(data){
                  alert(data.message);
                });
    

          } else {
             swal("Cancelled", "You have no new friend :)", "error");
          }
        });




           });
//confirm friend end
//DELETE FRIEND REQUEST
$(".deleteBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/deletefriend/"+f;
             swal({
          title: "Are you sure?",
          text: "Once deleted, Friend request will be rejected",
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
                  contentType: false,
                  processData: false,
                  data:{r:Math.random()}
                }).done(function(data){
                // console.log(data);
                // return;
                  if(data.success){
                    swal("Deleted", data.message, "success");
                    t.parent().parent().remove();

                  // location.reload();
                  }
                  //console.log(data);
                }).fail(function(data){
                  alert(data.message);
                });
    

          } else {
             swal("Cancelled", "You have no new friend :)", "error");
          }
        });




           });
//Delete requests end
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
    $(document).on('click', '.deleteComment', function (e){
        console.log("clicked")
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

    {{-- Add Comment --}}

<script>
  //  Submit comment on enter
  document.getElementById('comment').addEventListener('keypress', function(event) {
      if (event.keyCode == 13) {
          event.preventDefault();
          $.ajax({
              url: "{{ route('posts.comment.ajax', $userpost->id) }}",
              method:"POST",
              data: {
                  comment: $(this).val(),
                  post_id: '{{ $userpost->id }}'
              },
              success: function(res) {
                  console.log(res)

                  $('#comment').val("")

                  const comment = `<div class="comment-wrapper" id="${ res.data.comment_id }">
                      <img src="${ res.data.profile_pic }" alt="user" class="profile-photo-md"/>
                      <div class="comment-body">
                          <h5 class="commenter-name">${ res.data.user_name }</h5>
                          <small class="text-muted">${res.data.time}</small>
                          <h5>${ res.data.comment }</h5>
                      </div>
                      {!! Form::open(['url' => 'deleteComment/${res.data.comment_id}','method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment','style' => 'position: absolute; right: 0%']) !!}
                          <span class="label label-danger deleteComment"><i class="fa fa-trash"></i></span>
                      {!! Form::close() !!}
                      <hr/>
                  </div>`;

                  $('.commentContainer').append(comment)

              },
              error: function(err) {
                  console.log(err)
              }            
          })
      }
  });
</script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
