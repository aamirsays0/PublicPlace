@extends("layouts.blue")

  <body>
  

@include('partials.headermenu')
    <div class="container">

      <!-- Timeline
      ================================================= -->
       <div class="timeline">
      <div class="timeline-cover" style="background-image: url('{{asset('storage/profile/'.Auth::id().'_cover.jpg')}} ')" data-lightbox="cp">
      <div id="showcpbtncontainer">
      <span><i class ="fa fa-expand text-dark"></i></span>
     </div>
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                <a href="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" data-lightbox="pp">
                <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="img-fluid profile-photo"/>
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

          <!--Timeline Menu for Small Screens-->
          <!-- <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              <img src="images/users/user-1.jpg" alt="" class="img-responsive profile-photo">
              <h4>Sarah Cruiz</h4>
              <p class="text-muted">Creative Director</p>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                <li><a href="timline.html">Timeline</a></li>
                <li><a href="timeline-about.html" class="active">About</a></li>
                <li><a href="timeline-album.html">Album</a></li>
                <li><a href="timeline-friends.html">Friends</a></li>
              </ul>
              <button class="btn-primary">Add Friend</button>
            </div>
          </div> --><!--Timeline Menu for Small Screens End-->

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
              
      
              <ul class="edit-menu " style="margin-top: 80px">
                <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
                  <i class="icon ion-ios-information-outline"></i>
                  @if ( isset($user) && $user->id === Auth::id())
                  <a href="{{url('profiles')}}">  Edit Basic Information</a>
                  @else
                  <a href="{{ route('view.friends.profile', $user->id) }}">  Basic Information</a>
                  @endif
                </li><br>
                <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
                @if ( isset($user) && $user->id === Auth::id())
                  <i class="icon ion-ios-information-outline"></i>
                  <a href="{{ route('view.friends.profile', $user->id) }}">Basic Information</a>
                   @endif
                </li><br>
                  <li class='{{Route::current()->uri == 'education'?'active': ''}}'><i class="icon ion-ios-briefcase-outline"></i>
                  @if ( isset($user) && $user->id === Auth::id())
                  <a href="{{url('education')}}">  Education & Work</a>
                  @else
                  <a href="{{ route('view.friends.education', $user->id) }}">  Education & Work</a>
                  @endif        </li><br>
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
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i> Edit basic information</h4>
                  <div class="line"></div>
                </div>
                <div class="edit-block">
                {!! Form::open([
                'url' => 'profiles',
                'files'=>true, 'class'=>'form', 'enctype' =>'multipart/form-data']) !!}
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="firstname">First name</label>
                        <input id="firstname" class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name"
                         @if($user->profiles)
                          value="{{$user->profiles->f_name}}"
                          @endif
                          />
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="lastname" class="">Last name</label>
                        <input id="lastname" class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name"
                         @if($user->profiles)
                          value="{{$user->profiles->l_name}}"
                          @endif
                        />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="email">My email</label>
                        <input id="email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" placeholder="My Email"
                         @if($user->profiles)
                          value="{{$user->profiles->u_mail}}"
                          @endif
                        />
                      </div>
                    </div>
                    <div class="row">
                    <div class="form-group gender ">
                      <span class="custom-label pt-1"><strong>I am a: </strong></span>
                      <label class="radio-inline pr-1">
                        <input type="radio" value="m" name="sex" 
                         @if($user->profiles) 
                           @if($user->profiles->sex == "m")
                              checked
                              @endif
                              @endif
                              /> Male 
                      </label>
                      <label class="radio-inline pr-1">
                        <input type="radio" value="f" name="sex" 
                         @if($user->profiles) 
                          @if($user->profiles->sex == "f")
                              checked
                              @endif
                              @endif
                              /> Female
                      </label>
                      <label class="radio-inline pr-1">
                        <input type="radio" value="o" name="sex"
                         @if($user->profiles) 
                          @if($user->profiles->sex == "o")
                              checked
                              @endif
                              @endif
                              />others
                      </label>
                    </div>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="dob">Date of Birth</label>
                        <input id="dob" class="form-control input-group-lg" type="date" name="dob" title="Enter dob" placeholder="My dob"
                         @if($user->profiles)
                          value="{{$user->profiles->dob}}"
                          @endif
                        />
                      </div>
                      <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="city"> My city</label>
                        <input id="city" class="form-control input-group-lg" type="text" name="city" title="Enter city" placeholder="Your city"
                         @if($user->profiles)
                          value="{{$user->profiles->city}}"
                          @endif
                        />
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="country">My country</label>
                        @if($user->profiles)
                        {{Form::select('country', $country,$user->profiles->country, ['class'=> 'form-control'] )}}
                        @else
                        {{Form::select('country', $country, null, ['class'=> 'form-control'])}}

                          @endif

                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-info">About me</label>
                        <textarea id="my-info" name="information" class="form-control" placeholder="Some texts about me" rows="4" cols="400">
                        @if($user->profiles)
                          {{$user->profiles->description}}
                          @endif
                        </textarea>
                      </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                          <label for="my-info">Profile picture</label>
                          <input type="file" name="ppic" class="form-control-file profiles_file_display" id="my-info">
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                          <label for="my-info">Cover Picture</label>
                          <input type="file" name="cpic" class="form-control-file profiles_file_display" id="my-info">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    {!! Form::close() !!}

                </div>
              </div>
            </div>
            <div class="col-md-2 static">
          <div id="sticky-sidebar">
            <h4 class="grey">Your activities</h4>
            @foreach ($allActivity as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p>
                  <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize">You {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }}</a>
                  </p>
                  <p class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                </div>
              </div>
            @endforeach          
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
