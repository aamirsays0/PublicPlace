<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                @if (file_exists(public_path('storage/profile/'.$user_information->id.'_profile.jpg')) )
                <a href="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" data-lightbox="pp">
                <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-fluid profile-photo"/>
                 </a>
                 @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo" id="uploadImage" alt="">
                 @endif
                 <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$user_information->id)}}">Timeline</a></li>
                  <li><a href="{{url('profiles/about')}}">About</a></li>
                  <li><a href="{{route('user.album.show',$user_information->id)}}">Album</a></li>
                  <li><a href="{{route('user.friends',$user_information->id)}}">Friends</a></li>
                </ul>
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
                  <li><a href="timeline-about.html">About</a></li>
                  <li><a href="{{route('user.album.show',$user_information->id)}}">Album</a></li>
                  <li><a href="{{route('user.friends',$user_information->id)}}">Friends</a></li>
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
                    <a href="{{url('profiles')}}"> Edit Basic Information</a>
                    @else
                    <a href="{{ route('view.friends.profile', $user_information->id) }}"> Basic Information</a>
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
                      <a href="{{url('education')}}">  Education & Work</a>
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

              <!-- Basic Information
              ================================================= -->
              <div class="edit-profile-container">
                <div class="edit-block">
                   <div class="row">
                   @if($user_information->profiles)
                        <div class="col-md-6 col-sm-12">
                            <h5>Email: <span style="color: #7f8c8d">{{ $user_information->email }}</span> </h5>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h5>Location: <span style="color: #7f8c8d">{{ $user_information->profiles->city }}</span> </h5>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <h5>Gender: <span style="color: #7f8c8d">{{ $user_information->profiles->sex }}</span> </h5>
                        </div>
                        
                        <div class="col-md-6 col-sm-12">
                           <h5>Age: <span style="color: #7f8c8d">{{ isset($user_information->profiles->dob) ? \Carbon\Carbon::parse($user_information->profiles->dob)->age : "" }}</span> </h5>
                        </div>
                        
                        <div class="col-md-12">
                            <h5>Bio</h5>
                            <h5 style="color: #7f8c8d">{{ $user_information->profiles->description }}</h5>
                        </div>
                    @else
                    <h4>This user has no profile information</h4>
                    @endif
                   </div>
                </div>
              </div>
            </div>
   <div class="col-md-2 static">
          <div id="sticky-sidebar">
          @if($user_information->id == Auth::id())
          <h4 class="grey">Your Activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                    @if($activity->type == "post")
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You added a Post</a>
                    @else
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize">You {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ $activity->post->user->name }}</a>
                    @endif   
                  </p>
                  <p class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                </div>
              </div>
            @endforeach          

            @else
            <h4 class="grey">{{ isset($user_information->profiles->f_name) ? ucfirst($user_information->profiles->f_name) : ucfirst($user_information->name) }}'s Activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                    @if($activity->type == "post")
                     <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} added a Post</a>
                    @else
                     <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on a Post</a>
                     <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? $activity->post->user->profiles->f_name : $activity->post->user->name }}</a>
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

  </body>
</html>
