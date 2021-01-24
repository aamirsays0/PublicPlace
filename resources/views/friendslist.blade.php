@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
@endpush


@section('sidebar-left')
<div id="sticky-sidebar">
        <div class="profile-card static" style="background-image: linear-gradient(to bottom, rgb(4 76 89 / 16%), rgb(4 76 89 / 85%)), url('{{asset('storage/profile/'.Auth::id().'_cover.jpg')}} ');">
                    @if (file_exists(public_path('storage/profile/'.Auth::id().'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="profile-photo " />
                    @else
                       <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo" id="uploadImage" alt="">
                    @endif
             	  <h5><a class="text-white">{{ isset(Auth::user()->profiles->f_name) ? Auth::user()->profiles->f_name.' '.Auth::user()->profiles->l_name: Auth::user()->name}}</a></h5>
            	   <a href="{{url('friends/'.Auth::id())}}" class="text-white" title="{{$friends->count()-1}} Friends"><i class="ion ion-android-person-add"></i>{{$friends->count()-1}} Friends</a>
          </div>
<!--profile card ends-->
        <ul class="nav-news-feed">

              <li><i class="icon ion-ios-paper"></i><div><a href="{{url('profiles/'.Auth::id())}}">My Timeline</a></div></li>
              <li><i class="icon ion-ios-people"></i><div><a href="{{ route('people.nearby')}}">People Nearby</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="{{url('friends/'.Auth::id())}}">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="{{url('chat')}}">Messages</a></div></li>
              <li><i class="icon ion-images"></i><div><a href="{{route('my.images')}}">Images</a></div></li>
              <li><i class="icon ion-ios-videocam"></i><div><a href="{{route('my.videos')}}">Videos</a></div></li>
            </ul><!--news-feed links ends-->
        <!-- <div id="friends-block">
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
              
            </div> -->  <!--Friends block ends -->
            <!-- <div id="chat-block">
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
            </div>  -->
            <!--chat block ends-->
            </div>
@endsection

@section('content')
     
              <!-- Friend List
              ================================================= -->
              <div class="friend-list">
                <div class="row">
                @forelse($friends as $friend)
                  @if($friend->id == Auth::id())
                   @continue
                   @endif
                  <div class="col-md-6 col-sm-6" id="{{ $friend->id }}">
                    <div class="friend-card">
                        <a href="#" class="unfriend_it friend--trash_icon" data-friend_id="{{ $friend->id }}"><i class="fa fa-trash fa-lg"></i></a>
                        @if (file_exists(public_path('storage/profile/'.$friend->id.'_cover.jpg')) )
                         <img src="{{asset('storage/profile/'.$friend->id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                         @else
                         <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                         @endif
                        <div class="card-info">
                        @if (file_exists(public_path('storage/profile/'.$friend->id.'_profile.jpg')) )
                        <img src="{{asset('storage/profile/'.$friend->id.'_profile.jpg')}}" alt="user" class="profile-photo-lg"/>
                        @else
                       <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-lg" id="uploadImage" alt="">
                        @endif
                      <div class="friend-info">
                         <a href="#" class="pull-right text-green">My Friend</a>
                          <h5><a href="{{url('profiles/'.$friend->id)}}" class="profile-link">
                          {{$friend->profiles?$friend->profiles->f_name.' '.$friend->profiles->l_name : $friend->name}}</a></h5>
                          <p>{{$friend->email}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  <div class="col-md-12 col-sm-12 mt-5 text-center">
                    <h2 class="text-info">No Friends</h2>
                  </div>
                  @endforelse
                  
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
//JSCROLL
             $("ul.pagination").hide();
             $('.scroll').jscroll({
               autoTrigger: true,
               nextSelector : '.pagination li.active + li a',
               contentSelector: 'div.scroll',
               callback: function(){
                 $('ul.pagination:visible:first').hide();
               }
             });
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
     $("#contentpostContainer").on("click",".reactionBtn", function(){
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
            r:Math.random()}
        }).done(function(data){
         console.log(data);
         // return;
          if(data.success){
            //alert(data.message);
            location.reload();
            
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
    $('.unfriend_it').on('click', function(e) {
        let friend_id = $(this).data('friend_id');
        
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
        $.ajax({
          method: "DELETE",
          url   : `/friend/unfriend_it/${friend_id}`,
          success: (response) => {
            console.log(response)
            $(`#${friend_id}`).remove();
          },
          error:   (response) => {
            console.error(response)
          }
        })
     })
    });
    </script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush