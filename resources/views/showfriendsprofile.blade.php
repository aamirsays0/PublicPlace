@extends("layouts.blue")
  <body>
  

@include('partials.headermenu')
    <div class="container">

      <!-- Timeline
      ================================================= -->
       <div class="timeline">
      <div class="timeline-cover" style="background-image: url('{{asset('storage/profile/'.$user->id.'_cover.jpg')}} ')" data-lightbox="cp">
      <div id="showcpbtncontainer">
      <span><i class ="fa fa-expand text-dark"></i></span>
     </div>
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                <a href="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}" data-lightbox="pp">
                <img src="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}" alt="" class="img-fluid profile-photo"/>
                 </a>
                 <h4>{{isset($user->profiles->f_name , $user->profiles->l_name) ? $user->profiles->f_name.' '.$user->profiles->l_name : $user->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$user->id)}}">Timeline</a></li>
                  <li><a href="{{url('profiles/about')}}">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="{{url('friends/'.$user->id)}}">Friends</a></li>
                </ul>
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->


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
      @if ( isset($user) && $user->id === Auth::id())
      <a href="{{url('profiles')}}"> Edit Basic Information</a>
      @else
      <a href="{{ route('view.friends.profile', $user->id) }}"> Basic Information</a>
      @endif
    </li><br>
    <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
      @if ( isset($user) && $user->id === Auth::id())
      <i class="icon ion-ios-information-outline"></i>
      <a href="{{ route('view.friends.profile', $user->id) }}">Basic Information</a>
       @endif
    </li>
      <li class='{{Route::current()->uri == 'education'?'active': ''}}'><i class="icon ion-ios-briefcase-outline"></i>
      @if ( isset($user) && $user->id === Auth::id())
      <a href="{{url('education')}}">  Education & Work</a>
      @else
      <a href="{{ route('view.friends.education', $user->id) }}">  Education & Work</a>
      @endif        
      </li>
      <li class='{{Route::current()->uri == 'update'?'active': ''}}'>
      @if ( isset($user) && $user->id === Auth::id())
      <i class="icon ion-ios-locked-outline"></i>
      <a href="{{url('change-password')}}">  Change Password</a>
      @endif</li>

  </ul>   
           </div>
   <div class="col-md-7" style="padding-right: 30px;">

              <!-- Basic Information
              ================================================= -->
              <div class="edit-profile-container">
                <div class="edit-block">
                   <div class="row">
                   @if($user->profiles)
                        <div class="col-md-6 col-sm-12">
                            <h5>Email: <span style="color: #7f8c8d">{{ $user->email }}</span> </h5>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h5>Location: <span style="color: #7f8c8d">{{ $user->profiles->city }}</span> </h5>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <h5>Gender: <span style="color: #7f8c8d">{{ $user->profiles->sex }}</span> </h5>
                        </div>
                        
                        <div class="col-md-6 col-sm-12">
                           <h5>Age: <span style="color: #7f8c8d">{{ isset($user->profiles->dob) ? \Carbon\Carbon::parse($user->profiles->dob)->age : "" }}</span> </h5>
                        </div>
                        
                        <div class="col-md-12">
                            <h5>Bio</h5>
                            <h5 style="color: #7f8c8d">{{ $user->profiles->description }}</h5>
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
          @if($user->id == Auth::id())
          <h4 class="grey">Your Activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize">You {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ $activity->post->user->name }}</a>
                  </p>
                  <p class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                </div>
              </div>
            @endforeach          

            @else
            <h4 class="grey">Activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ $activity->post->user->name }}</a>
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
    
  </body>
</html>
