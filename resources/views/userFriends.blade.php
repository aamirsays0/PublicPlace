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
      <div class="timeline-cover" style="background-image: url('{{asset('storage/profile/'.$user_information->id.'_cover.jpg')}} ')" data-lightbox="cp">
      <div id="showcpbtncontainer">
      <span><i class ="fa fa-expand text-dark"></i></span>
     </div>
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                <a href="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" data-lightbox="pp">
                <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-fluid profile-photo"/>
                 </a>
                 <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$user_information->id)}}">Timeline</a></li>
                  <li><a href="{{url('profiles/about')}}">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="{{url('friends/'.$user_information->id)}}">Friends</a></li>
                </ul>
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->
          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
            @if (file_exists(public_path('storage/profile/'.$user_information->profiles->id.'_profile.jpg')) )
                    <a href="{{asset('storage/profile/'.$user_information->profiles->id.'_profile.jpg')}}" data-lightbox="pp">
                    <img src="{{asset('storage/profile/'.$user_information->profiles->id.'_profile.jpg')}}" alt="" class="img-responsive profile-photo"/>
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive profile-photo" id="uploadImage" alt="">
                   @endif
                   </a>
                   <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                  <li><a href="{{url('profiles/'.$user_information->profiles->id)}}" class="active">Timeline</a></li>
                  <li><a href="timeline-about.html">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="{{url('friends/'.$user_information->profiles->id)}}">Friends</a></li>
              </ul>
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
           <img class="img-fluid" id="modal_image_container" src="" alt="">
         </div>
     </div>
  </div>
</div>
      <div id="page-contents">
          <div class="row">
            <div class="col-md-3">
                              
                      
                <!--Edit Profile Menu-->
                <ul class="edit-menu " style="margin-top: 80px">
                    <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
                      <i class="icon ion-ios-information-outline"></i>
                      @if ( isset($user_information) && $user_information->id === Auth::id())
                      <a href="{{url('profiles')}}"> Edit Basic Information</a>
                      @else
                      <a href="{{ route('view.friends.profile', $user_information->id) }}"> Basic Information</a>
                      @endif
                    </li><br>
                    <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
                      @if ( isset($user_information) && $user_information->id === Auth::id())
                      <i class="icon ion-ios-information-outline"></i>
                      <a href="{{ route('view.friends.profile', $user_information->id) }}">Basic Information</a>
                       @endif
                    </li>
                      <li class='{{Route::current()->uri == 'education'?'active': ''}}'><i class="icon ion-ios-briefcase-outline"></i>
                      @if ( isset($user_information) && $user_information->id === Auth::id())
                      <a href="{{url('education')}}">  Education & Work</a>
                      @else
                      <a href="{{ route('view.friends.education', $user_information->id) }}">  Education & Work</a>
                      @endif        
                      </li>
                      <li class='{{Route::current()->uri == 'update'?'active': ''}}'>
                      @if ( isset($user_information) && $user_information->id === Auth::id())
                      <i class="icon ion-ios-locked-outline"></i>
                      <a href="{{url('change-password')}}">  Change Password</a>
                      @endif</li>
                
                  </ul>   
      </div>
     <div class="col-md-7" id="contentpostContainer">
     
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
                         <img src="{{ asset('images/no-cover.png') }}" class="img-responsive cover" id="uploadImage" alt="">
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
            </div>
        <div class="col-md-2 static">
          <div id="sticky-sidebar">
          @if($user_information->id == Auth::id())
          <h4 class="grey">Your activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                  <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? $activity->post->user->profiles->f_name : $activity->post->user->name }}</a>
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
                  <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? $activity->post->user->profiles->f_name : $activity->post->user->name }}</a>
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
    <script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/lightbox.min.js')}}"></script>
    <script src="{{asset('js/jquery.jscroll.min.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="http://unpkg.com/ionicons@4.4.2/dist/ionicons.js"></script>
  	<script src="{{asset('js/jquery.validate.min.js')}}"></script>
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
