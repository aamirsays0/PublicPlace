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
   @include('partials.leftSidebar')

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
      <h5>People Search Results</h5>
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

                    <h5>
                    <div class="profile-link1">
                    <a href="{{url('profiles/'.$user->id)}}" class="profile-link">{{$user->profiles?$user->profiles->f_name.' '.$user->profiles->l_name:$user->name}}</a>
                    <div class="friend-card1">
                        @if (file_exists(public_path('storage/profile/'.$user->id.'_cover.jpg')) )
                         <img src="{{asset('storage/profile/'.$user->id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                         @else
                         <img src="{{ asset('images/no-cover.png') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                         @endif
                        <div class="card-info">
                             @if (file_exists(public_path('storage/profile/'.$user->id.'_profile.jpg')) )
                             <img src="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}" alt="user" class="profile-photo-md"/>
                             @else
                            <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="user">
                             @endif
                           <div class="friend-info">
                                  <h5><a href="{{url('profiles/'.$user->user_id)}}" class="profile-link">
                                   {{$user->profiles?$user->profiles->f_name.' '.$user->profiles->l_name:$user->name}}</a>
                                                     
                                      @if(in_array($user->id,$req))
                                        @if (Auth::user()->id !== $user->id)
                                         <span class="pull">Friends</span>
                                        @endif
                                      @else
                                      {{-- @if(array_search($user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                                        @if((array_search($user->id, array_column($his_friends, 'user_id')) !== false) || 
                                          (array_search($user->id, array_column($his_friends, 'friend_id')) !== false))
                                         <button class="btn pull pending" disabled>Pending</button>
                                        @else 
                                        <button class="btn pull addFrndBtn" data-uid="{{$user->id}}">Add Friend</button>
                                       @endif
                                      @endif
                                </h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-envelope"></i>  {{$user->email}}</h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-map-marker" aria-hidden="true"></i>  {{$user->profiles?$user->profiles->city:"No city details"}}, {{$user->profiles?$user->profiles->country:"No country details"}}</h5>
                                  <h5 style="color: #7f8c8d">{{ $user->profiles?$user->profiles->description:"No Description" }}</h5>
                                <table class="tablecard">
                                    <tr>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>{{$user->posts->count()}}</b></h5>
                                          <h5 style="color: #7f8c8d">Posts</h5>
                                        </td>
                                        <td>
                                        <h5 style="color: #7f8c8d"><b>{{$user->friend->count() + $user->friends2->count()}}</b></h5>
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
                    <p style="font-size: 1.7rem;">{{$user->email}}</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    @if(in_array($user->id,$req))
                    @if (Auth::user()->id !== $user->id)
                        <span class="pull">Friends</span>
                      @endif
                    @else
                    {{-- @if(array_search($user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                                        @if((array_search($user->id, array_column($his_friends, 'user_id')) !== false) || 
                                          (array_search($user->id, array_column($his_friends, 'friend_id')) !== false))
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
                  @if (file_exists(public_path('storage/profile/'.$post->user_id.'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.$post->user_id.'_profile.jpg')}}" alt="user" class=" img-responsive profile-photo-md pull-left" />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive profile-photo-md pull-left" id="uploadImage" alt="">
                   @endif
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
                    {!! Form::open(['url' => 'posts/'.$post->id,'method' => 'delete','class' => 'btn d-inline', 'id' => 'delete-button']) !!}
                    <button class="btn btn-danger fa fa-trash"></button>

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
                    @if (isset($post->videos[0]))
                     <video width="320" height="240" controls>
                      <source src="{{ asset('storage/postvideos/'.$post->videos[0]->vidname) }}" type="video/mp4">
                      Your browser does not support the video tag.
                     </video> 
                    @endif
 
                    
                  </div>
                  <div class="line-divider"></div>
                  <div class="viewpost"><a href="javascript:void(0)" class="commentToggleBtn">{{$post->comments->count()}} 
                    <span><i class="fa fa-comment" style="font-size: 18px;"></i></span>
                  </a>
                  <div class="commentContainer" style="display: none;">
                   @forelse($post->comments as $usercomment)
                    <div class="post-comment">
                      @if (file_exists(public_path('storage/profile/'.$usercomment->user_id.'_profile.jpg')) )
                      <img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                        @else
                        <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-sm" id="uploadImage" alt="">
                       @endif
                    <p><a href="{{url('profiles/'.$usercomment->user->id)}}" class="profile-link">{{$usercomment->user->profiles?$usercomment->user->profiles->f_name.' '.$usercomment->user->profiles->l_name:$usercomment->user->name}}</a>
                    {{$usercomment->comment}}</p>
                    @if (Auth::check())
                    @if(count((array) $post->comments) > 0)
                    @if($usercomment->user->id == Auth::user()->id)
                    {!! Form::open(['url' => 'deleteComment/'.$usercomment->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment']) !!}
                    <button class="btn btn-danger fa fa-trash deleteComment"></button>
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
                       @if (file_exists(public_path('storage/profile/'.Auth::id().'_profile.jpg')) )
                       <img src="{{asset('storage/profile/'.Auth::id().'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                             @else
                             <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-sm" id="uploadImage" alt="">
                       @endif
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
       <h5>No posts avaliable</h5>
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
      
      $(".nearby-user").on("click",".addFrndBtn",function(){
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
                 swal("Cancelled", "You have no new friends :)", "error");
               }
             });
     
     
     
     
      });
 //add friend from post
          $(".nearby-user").on("click",".addFrndBtn1",function(){
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
                     swal("Cancelled", "You no new friends :)", "error");
                   }
                 });
         
         
         
         
          });
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
    @endsection
  </body>
</html>
