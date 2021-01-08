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
<div id="sticky-sidebar">
        <div class="profile-card static" style="background-image: url('{{asset('storage/profile/'.Auth::id().'_cover.jpg')}} ');">
                    @if (file_exists(public_path('storage/profile/'.Auth::id().'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="profile-photo-md " />
                    @else
                       <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="">
                    @endif
             	  <h5><a class="text-white">{{ isset(Auth::user()->profiles->f_name) ? Auth::user()->profiles->f_name.' '.Auth::user()->profiles->l_name: Auth::user()->name}}</a></h5>
            	   <a href="{{url('friends/'.Auth::id())}}" class="text-white" title="{{$friends->count()-1}} Friends"><i class="ion ion-android-person-add"></i>{{$friends->count()-1}} Friends</a>
          </div>
          </div>
<!--profile card ends-->
        <ul class="nav-news-feed">

              <li><i class="icon ion-ios-paper"></i><div><a href="{{url('profiles/'.Auth::id())}}">My Timeline</a></div></li>
              <li><i class="icon ion-ios-people"></i><div><a href="{{ route('people.nearby')}}">People Nearby</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="{{url('friends/'.Auth::id())}}">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="{{url('chat')}}">Messages</a></div></li>
              <li><i class="icon ion-images"></i><div><a href="{{url('images/'.Auth::id())}}">Images</a></div></li>
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
     
        <!-- Post Create Box
            ================================================= -->
        <div class="row" id="showErrors">

        </div>
        <div class="create-post">
  
            <form action="{{ route('posts.create') }}" enctype="multipart/form-data" class="postform" id="postform" novalidate>
              @csrf
            	<div class="row">
            		<div class="col-12">
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
            		<div class="col-md-12">
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
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <div class="preview"></div>

                  </div>

                </div>

              </div>
               </form>
            </div><!-- Post Create Box End-->

       @if ($message = Session::get('success'))
              <div class="alert alert-success" id="errorcontainer">
              <h3>{{$message}}</h3>
              </div>
              @endif
       <div class="scroll">
      
       @forelse($posts as $post)

            

            <!-- Post Content
            ================================================= -->
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
                      @if($his_friends->where('friend_id', $post->user->id)->where('approved', 0)->where('blocked', 0)->first())
                      <button class="btn pull pending" disabled>Pending</button>
                      @else 
                      <button class="btn pull addFrndBtn" data-uid="{{$post->user->id}}">Add Friend</button>
                      @endif
                    @endif</h5>
                    <p class="text-muted">Published about {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
                  </div>
                  <video width="320" height="240" controls>
                    <source src="{{ asset('storage/postimages/vid.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>
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
                    <!-- DELETE ICON -->
                    <!--<a href={{url('post'.'/'.$post->id) }}" onclick="event.preventDefault(); document.getElementById('delete-post').submit();" class="fa fa-trash"></a><form id="delete-post" action="{{ url('post'.'/'.$post->id)}}" method="DELETE" style="display: none;"@csrf</form>-->
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
        {{ $posts->links() }}
        </div>
@endsection

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
    alert(url);
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
    </script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
