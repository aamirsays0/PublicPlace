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
     
        <!-- Post Create Box
            ================================================= -->
        <div class="row" id="showErrors">

        </div>
        <div class="create-post">
        <div class="row">
  
            <form action="{{ route('posts.create') }}" enctype="multipart/form-data" class="postform" id="postform" novalidate>
              @csrf
            	<div class="row">
            		<div class="col-md-6 col-sm-6">
                  <div class="form-group w-100" >
                    @if (file_exists(public_path('storage/profile/'.Auth::id().'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="homepage-profile-avatar" />
                    @else
                       <img src="{{ asset('images/noimage.jpg') }}" class="homepage-profile-avatar" id="uploadImage" alt="">
                    @endif
                    <textarea name="contentpost" id="contentpost" rows="2" class="form-control" placeholder="Write what you wish" required></textarea>
                  </div>
                 <!-- <div class="form-group">
                  <label for="post-images" title="Upload Images">
                  <img src="{{asset('images/envato.png')}}"/>
                  </label>
                <input type="file" id="post-images" class="d-none" name="photos[]" accept="image/gif, image/jpeg, image/png" multiple/>
                  <div class="preview"></div>
                  </div>-->
                </div>
            		<div class="col-md-6 col-sm-5">
                  <div class="tools">
                  
					        <ul class="publishing-tools list-inline list-unstyled">
                        <li class="list-inline-item"><a href="#"><i class="ion-compose ion-icons-colors"></i></a></li>
                        <li class="list-inline-item">
                        <label for="post-images" title="Upload Images">
                        <i class="ion-images fa-lg ion-icons-colors"></i>
                          </label>
                           <input type="file" id="post-images" class="d-none" name="photos[]" accept="image/gif, image/jpeg, image/png" multiple/>

                               </li>
                        <li class="list-inline-item"><label for="post-videos" title="Upload videos"><i class="ion-ios-videocam ion-icons-colors"></i></label><input type="file" id="post-videos" class="d-none" name="videos[]" accept="video/MOV, video/mp4" multiple/></li>
                        <li class="list-inline-item">
                          <select id="privacy" class="form-control privacy1">
                            <option value="public">public</option>
                            <option value="friends">friends</option>
                          </select>
                        </li>
                    </ul>
                    <button type="button" id="publishpost" class="btn btn-primary pull-right">Publish</button>
                  </div>
                </div>
              </div>
              <div class="row1" style="display: flex;">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <div class="preview"></div>

                  </div>

                </div>

              </div>
               </form>
               </div>
            </div><!-- Post Create Box End-->

       <div class="scroll scoll-page-content" >
      
       @forelse($posts as $post)

            <!-- Post Content
            ================================================= -->
            <div class="post-content  postid-{{$post->id}}">
            
              <div class="post-container">
                <img src="{{asset('storage/profile/'.$post->user_id.'_profile.jpg')}}" alt="user" class=" img-responsive profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5>
                    <div class="profile-link1">
                    <a href="{{url('profiles/'.$post->user->id)}}" class="profile-link">{{$post->user->profiles?$post->user->profiles->f_name.' '.$post->user->profiles->l_name:$post->user->name}}</a>
                    <div class="friend-card1">
                        @if (file_exists(public_path('storage/profile/'.$post->user_id.'_cover.jpg')) )
                         <img src="{{asset('storage/profile/'.$post->user_id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                         @else
                         <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                         @endif
                        <div class="card-info">
                             @if (file_exists(public_path('storage/profile/'.$post->user_id.'_profile.jpg')) )
                             <img src="{{asset('storage/profile/'.$post->user_id.'_profile.jpg')}}" alt="user" class="profile-photo-md"/>
                             @else
                            <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="user">
                             @endif
                           <div class="friend-info">
                                  <h5><a href="{{url('profiles/'.$post->user_id)}}" class="profile-link">
                                   {{$post->user->profiles?$post->user->profiles->f_name.' '.$post->user->profiles->l_name:$post->user->name}}</a>
                                                     
                                      @if(in_array($post->user->id,$req) )
                                        @if (Auth::user()->id !== $post->user->id)
                                          <span class="pull pull-right">Friends</span>
                                        @endif
                                      @else
                                        @if(array_search($post->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' )))
                                        <button class="btn pull pending pull-right" disabled>Pending</button>
                                        @else 
                                        <button class="btn pull addFrndBtn pull-right" data-uid="{{$post->user->id}}">Add Friend</button>
                                        @endif
                                      @endif
                                    </h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-envelope"></i>  {{$post->user->email}}</h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-map-marker" aria-hidden="true"></i>  {{$post->user->profiles?$post->user->profiles->city:"No city details"}}, {{$post->user->profiles?$post->user->profiles->country:"No country details"}}</h5>
                                  <h5 style="color: #7f8c8d">{{ $post->user->profiles?$post->user->profiles->description:"No Description" }}</h5>
                                <table class="tablecard">
                                    <tr>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>{{$post->user->posts->count()}}</b></h5>
                                          <h5 style="color: #7f8c8d">Posts</h5>
                                        </td>
                                        <td>
                                          <h5 style="color: #7f8c8d">
                                            <b>{{$post->user->friend->count() + $post->user->friends2->count()}}</b>
                                          </h5>
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
                      @if(array_search($post->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' )))
                      <button class="btn pull pending" disabled>Pending</button>
                      @else 
                      <button class="btn pull addFrndBtn" data-uid="{{$post->user->id}}">Add Friend</button>
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
                    <button class="btn btn-danger fa fa-trash" ></button>

                    {!! Form::close() !!}                   
                    <!-- DELETE ICON -->
                    <!--<a href={{url('post'.'/'.$post->id) }}" onclick="event.preventDefault(); document.getElementById('delete-post').submit();" class="fa fa-trash"></a><form id="delete-post" action="{{ url('post'.'/'.$post->id)}}" method="DELETE" style="display: none;"@csrf</form>-->
                    @endif

                    
                  </div>
                  <div class="post-text">
                    <p>{{$post->content}}</p>
                    <hr>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
 
                        <ol class="carousel-indicators">
                         @foreach($post->pictures as $pic)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                         @endforeach
                        </ol>
                       
                 <div class="carousel-inner" role="listbox">
                    @forelse($post->pictures as $pic)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <?php
                    $imageinfo = pathinfo(url('/storage/postimages/'.$pic->imgname));
                    //print_r($imageinfo);
                    ?>
                    <a href="{{url('/storage/postimages/'.$pic->imgname)}}" data-lightbox="imageset-{{$post->id}}">
                    <img src=" {{url('/storage/postimages/'.$imageinfo['filename'].".".$imageinfo['extension'])}}" alt="" width="400px">
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
                    @if (isset($post->videos[0]))
                   <video width="320" height="240" controls>
                    <source src="{{ asset('storage/postvideos/'.$post->videos[0]->vidname) }}" type="video/mp4">
                    Your browser does not support the video tag.
                  </video> 
                  @endif
                    
                  </div>
                  <div class="viewpost"><a href="javascript:void(0)" class="commentToggleBtn">{{$post->comments->count()}} 
                    <span><i class="fa fa-comment" style="font-size: 18px;"></i></span>
                  </a>
                  <!-- <div class="commentContainer" style="display: none;">
                  @forelse($post->comments as $usercomment)
                    <div class="post-comment">
                         <img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                         <p><a href="{{url('profiles/'.$usercomment->user->id)}}" class="profile-link">{{$usercomment->user->profiles?$usercomment->user->profiles->f_name.' '.$usercomment->user->profiles->l_name:$usercomment->user->name}}</a>
                         <span class="text-muted">{{\Carbon\Carbon::parse($usercomment->created_at)->diffForHumans()}}</span>
                         {{$usercomment->comment}}</p>
                         @if (Auth::check())
                         @if(count((array) $post->comments) > 0)
                         @if($usercomment->user->id == Auth::user()->id)
                         {!! Form::open(['url' => 'deleteComment/'.$usercomment->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment','style' => 'position: absolute; right: 0%']) !!}
                         <button class="btn fa fa-trash deleteComment"style="color: #e23a14;"></button>
                         {!! Form::close() !!}
                         @endif
                         @endif
                        @endif

                  </div>
                  @empty
                  <h5>No comments added yet</hf>
                  @endforelse
                  
                  </div> -->
                  <div class="comment-widgets m-b-20 commentContainer" style="display: none;">
                  @forelse($post->comments as $usercomment)
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
                                        <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
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
                                                        @if(array_search($usercomment->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' )))
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
                                                          <h5 style="color: #7f8c8d"><b>{{$usercomment->user->friends->count()-1}}</b></h5>
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
                                @if(count((array) $post->comments) > 0)
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
                   @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif

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
       <h3>No posts avaliable. create new one</h3>
        @endforelse
        </div>
        <div class="col-12 scroll-page-pagination">
        {{ $posts->links() }}

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
  var template = '<a href="{{url('posts/')}}/'+data.pid+'" class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h5 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h5><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
              }
  else if(data.type == "reaction"){
    var template = '<a href="{{url('posts/')}}/'+data.pid+'" class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h5 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h5><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
  }

  console.log(data, "Pusher data");
         
  $("#notificationDropdown span.count").text(
    parseInt($("#notificationDropdown span.count").text())
    +1);
  $("#noteItemContainer").prepend(template);
 });
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
$(".post-detail").on("click",".addFrndBtn",function(){
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


//JSCROLL
            //  $("ul.pagination").hide();
            //  $('.scroll').jscroll({
            //    autoTrigger: true,
            //    nextSelector : '.pagination li.active + li a',
            //    contentSelector: 'div.scroll',
            //    callback: function(){
            //      $('ul.pagination:visible:first').hide();
            //    }

            //  });
//SCROLL ends

      /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES*/
    $(document).on('change', '#post-images',function(){
      $('.preview').html("");
      len_files = $("#post-images").prop("files").length;
      var construc = "<div class='row'>";
      for (var i = 0; i < len_files; i++){
        var file_data = $("#post-images").prop("files")[i];
        form_data.append("photos[]", file_data);
        construc += '<div class="col-3"><span class="btn btn-sm btn-danger imageremove">&times;</span><img width="120px" height="120px" src="' + window.URL.createObjectURL(file_data) + '"alt="' + file_data.name + '"/></div>';

      }
      construc += "</div>";
      $('.preview').append(construc);


    });
    $(document).on('change', '#post-videos',function(){
      $('.preview').html("");
      len_files = $("#post-videos").prop("files").length;
      var construc = "<div class='row'>";
      for (var i = 0; i < len_files; i++){
        var file_data = $("#post-videos").prop("files")[i];
        form_data.append("videos[]", file_data);
        construc += '<div class="col-3"><span class="btn btn-sm btn-danger vidremove">&times;</span><img width="120px" height="120px" src="' + window.URL.createObjectURL(file_data) + '"alt="' + file_data.name + '"/></div>';

      }
      construc += "</div>";
      $('.preview').append(construc);


    });
    $(".preview").on('click','span.imageremove',function(){
      //console.log($(this).next("img"));
      var trash = $(this).data("file");
      for(var i=0; i<storedFiles.length; i++){
       if(storedFiles[i].name === trash){
        storedFiles.splice(i,1);
        break;
       } 
      }
      $(this).parent().remove();

    }
    );
    $(".preview").on('click','span.vidremove',function(){
      //console.log($(this).next("img"));
      var trash = $(this).data("file");
      for(var i=0; i<storedFiles.length; i++){
       if(storedFiles[i].name === trash){
        storedFiles.splice(i,1);
        break;
       } 
      }
      $(this).parent().remove();

    }
    );

      $("#publishpost").click(function(){
        var url = '{{URL::to('/')}}' +"/posts";
        form_data.append("content", $("#contentpost").val());
        form_data.append("privacy", $("#privacy").val());

        //alert(url);
        $.ajax({
          method: "POST",
          url:url,
          cache: false,
          contentType: false,
          processData: false,
          data:form_data
        }).done(function(data){
          if(data.success){
            form_data = new FormData();
            storedFiles=[];
            location.reload();
     
        //RESET FORM AFTER POST
            $('postform').trigger("reset");
            $(".preview").html("");
          }
          //console.log(data);
        }).fail(function(err){
          $('#showErrors').html("")
          const errors = Object.values(err.responseJSON.messages)
            .map(error => {
               return error = `<li>${error}</li>`

            })
            .reduce((next, prev) => ( next = prev + next ));
            ;
            const setErrors = `
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
               <ul>${errors}</ul>
               </div>           
            </div>      
            `;

            $('#showErrors').append(setErrors)

        });
      });
//CONFIRM FRIEND REQUEST
           $(".confirmBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/confirmfriend/"+f;
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
                  contentType: false,
                  processData: false,
                  data:{r:Math.random()}
                }).done(function(data){
                // console.log(data);
                // return;
                  if(data.success){
                    swal("Cancelled", data.message, "error");
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

//DELETE FRIEND REQUEST
          $(".deleteBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/deletefriend/"+f;
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
                    alert(data.message);
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
          $("#contentpostContainer").on("click",".commentToggleBtn", function(){
            $(this).next(".commentContainer").toggle(250);

          });
//comment container show hide end
//post comment container show hide start
$("#contentpostContainer").on("click",".postcommentToggleBtn", function(){
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
// $('#publishpost').click(function() {
//   $('#publishpost').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
// });
    </script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
