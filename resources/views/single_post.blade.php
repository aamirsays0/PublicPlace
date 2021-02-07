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
            <div class="post-content  postid-{{$userpost->id}}">            
              <div class="post-container">
                <img src="{{asset('storage/profile/'.$userpost->user_id.'_profile.jpg')}}" alt="user" class=" img-responsive profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5>
                    <div class="profile-link1">
                    <a href="{{url('profiles/'.$userpost->user->id)}}" class="profile-link">{{$userpost->user->profiles?$userpost->user->profiles->f_name.' '.$userpost->user->profiles->l_name :$userpost->user->name}}</a> 
                    <div class="friend-card1">
                        @if (file_exists(public_path('storage/profile/'.$userpost->user_id.'_cover.jpg')) )
                         <img src="{{asset('storage/profile/'.$userpost->user_id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                         @else
                         <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                         @endif
                        <div class="card-info">
                             @if (file_exists(public_path('storage/profile/'.$userpost->user_id.'_profile.jpg')) )
                             <img src="{{asset('storage/profile/'.$userpost->user_id.'_profile.jpg')}}" alt="user" class="profile-photo-md"/>
                             @else
                            <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-lg" id="uploadImage" alt="">
                             @endif
                           <div class="friend-info">
                                  <h5><a href="{{url('profiles/'.$userpost->user_id)}}" class="profile-link">
                                   {{$userpost->user->profiles?$userpost->user->profiles->f_name.' '.$userpost->user->profiles->l_name:$userpost->user->name}}</a>
                                                     
                                      @if(in_array($userpost->user->id,$req) )
                                        @if (Auth::user()->id !== $userpost->user->id)
                                          <span class="pull pull-right">Friends</span>
                                        @endif
                                      @else
                                        @if(array_search($userpost->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' )))
                                        <button class="btn pull pending pull-right" disabled>Pending</button>
                                        @else 
                                        <button class="btn pull addFrndBtn pull-right" data-uid="{{$userpost->user->id}}">Add Friend</button>
                                        @endif
                                      @endif
                                    </h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-envelope"></i>  {{$userpost->user->email}}</h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-map-marker" aria-hidden="true"></i>  {{ $userpost->user->profiles->city}}, {{ $userpost->user->profiles->country}}</h5>
                                  <h5 style="color: #7f8c8d">{{ $userpost->user->profiles->description }}</h5>
                                <table class="tablecard">
                                    <tr>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>{{$userpost->user->posts->count()}}</b></h5>
                                          <h5 style="color: #7f8c8d">Posts</h5>
                                        </td>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>{{$userpost->user->friends->count()-1}}</b></h5>
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
                    @if(in_array($userpost->user->id,$req) )
                      @if (Auth::user()->id !== $userpost->user->id)
                        <span class="pull">Friends</span>
                      @endif
                    @else
                      @if($his_friends->where('friend_id', $userpost->user->id)->where('approved', 0)->where('blocked', 0)->first())
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
                    @if($userpost->user_id == Auth::id())
                    {!! Form::open(['url' => 'post/'.$userpost->id,'method' => 'delete','class' => 'btn d-inline', 'id' => 'delete-button']) !!}
                    <button class="btn btn-danger fa fa-trash"></button>
                    {!! Form::close() !!}                   
                    @endif

                    
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{$userpost->content}}</p>
                    <hr>
                    @forelse($userpost->pictures as $pic)
                    <?php
                    $imageinfo = pathinfo(url('/storage/postimages/'.$pic->imgname));
                    //print_r($imageinfo);
                    ?>
                    <a href="{{url('/storage/postimages/'.$pic->imgname)}}" data-lightbox="imageset-{{$userpost->id}}">
                    <img src=" {{url('/storage/postimages/'.$imageinfo['filename'].".".$imageinfo['extension'])}}" alt="" width="120px">
                    </a>
                    @empty

                    @endforelse
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
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
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

                  <div class="viewpost"><a class="">{{$userpost->comments->count()}} Comments</a>
                  <div class="commentContainer" >
                  @forelse($userpost->comments as $usercomment)
                    <div class="post-comment">
                          <img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                          <p><a href="{{url('profiles/'.$usercomment->user->id)}}" class="profile-link">{{$usercomment->user->name}}</a>
                          <span class="text-muted">{{\Carbon\Carbon::parse($usercomment->created_at)->diffForHumans()}}</span>
                          {{$usercomment->comment}}</p>
                          @if (Auth::check())
                            @if(count((array) $userpost->comments) > 0)
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
                  </div>
                </div>
                    </div>
              </div>
            </div>
      

@endsection

@section('sidebar-right')
<div class="suggestions" id="sticky-sidebar">
              <h4 class="grey" style="font-weight: 600;">Friend Requests</h4>
              <hr>
              @forelse($requests as $request)
               <div class="follow-user">
                <img src="{{asset('storage/profile/'.$request->user_id.'_profile.jpg')}}" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h6><a href="timeline.html">{{$request->user->name}}</a></h6>
                  <a class="confirmBtn text-green" data-uid="{{$request->user_id}}" href="javascript:void(0)">Confirm</a>
                  <a class="deleteBtn text-danger" href="javascript:void(0)">Delete</a>
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
 });
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
    $(".preview").on('click','span.imageremove',function(){
      console.log($(this).next("img"));

    }
    )



      $("#publishpost").click(function(){
        var url = '{{URL::to('/')}}' +"/post";
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
            alert(data.message);
            location.reload();
            
        //RESET FORM AFTER POST
            //$('postform').trigger("reset");
            //$(".preview").html("");
          }
          //console.log(data);
        }).fail(function(data){
          alert(data.message);
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
@push('style')

     .anothercss{ background-color: green;}

@endpush
