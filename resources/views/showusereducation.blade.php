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
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
		<link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/headerNewStyles.css')}}"/>
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png">
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
                  <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-responsive profile-photo"></a>
                 @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo" id="uploadImage" alt="">
                 @endif
                  <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$user_information->id)}}">Timeline</a></li>
                  <li><a href="{{route('user.album.show',$user_information->id)}}">Album</a></li>
                  <li><a href="{{route('user.friends',$user_information->id)}}">Friends</a></li>
                </ul>
                
                @if($user_information->id !== Auth::user()->id)
                 <ul class="follow-me list-inline">
                  <li>
                     @if(in_array($user_information->id,$req) )
                          @if (Auth::user()->id !== $user_information->id)
                             <span class=" btn pull pull-right" style="cursor: auto;">My Friend</span>
                           @endif
                      @else
                          {{-- @if(array_search($user_information->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                            @if((array_search($user_information->id, array_column($his_friends, 'user_id')) !== false) || 
                              (array_search($user_information->id, array_column($his_friends, 'friend_id')) !== false))
                             <button class="btn pull pending pull-right" disabled>Pending</button>
                            @else 
                             <button class="btn pull addFrndBtn pull-right" data-uid="{{$user_information->id}}">Add Friend</button>
                            @endif
                       @endif
                   </li>
                  </ul>
                 @endif
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->
          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              @if (file_exists(public_path('storage/profile/'.$user_information->id.'_profile.jpg')) )
                    <a href="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" data-lightbox="pp">
                    <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-responsive profile-photo"/></a>
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive profile-photo" id="uploadImage" alt="">
                   @endif
                   <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                  <li><a href="{{url('profiles/'.$user_information->id)}}">Timeline</a></li>
                  <li><a href="{{route('user.album.show',$user_information->id)}}">Album</a></li>
                  <li><a href="{{route('user.friends',$user_information->id)}}">Friends</a></li>
              </ul>
              
              @if($user_information->id !== Auth::user()->id)
                 <ul class="follow-me list-inline">
                  <li>
                     @if(in_array($user_information->id,$req) )
                          @if (Auth::user()->id !== $user_information->id)
                             <span class=" btn pull pull-right" style="cursor: auto;">My Friend</span>
                           @endif
                      @else
                          {{-- @if(array_search($user_information->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                            @if((array_search($user_information->id, array_column($his_friends, 'user_id')) !== false) || 
                              (array_search($user_information->id, array_column($his_friends, 'friend_id')) !== false))
                             <button class="btn pull pending pull-right" disabled>Pending</button>
                            @else 
                             <button class="btn pull addFrndBtn pull-right" data-uid="{{$user_information->id}}">Add Friend</button>
                            @endif
                       @endif
                   </li>
                  </ul>
                 @endif
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
              
<ul class="edit-menu " style="margin-top: 80px; display: grid;">
    <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
      <i class="icon ion-ios-information-outline"></i>
      @if ( isset($user_information) && $user_information->id === Auth::id())
      <a href="{{url('profiles')}}"> Edit Basic Information</a>
      @else
      <a href="{{ route('view.friends.profile', $user_information->id) }}">  Basic Information</a>
      @endif
    </li>
    @if ( isset($user_information) && $user_information->id === Auth::id())
    <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
      <i class="icon ion-ios-information-outline"></i>
      <a href="{{ route('view.friends.profile', $user_information->id) }}">Basic Information</a>
    </li>
    @endif
      <li class='{{Route::current()->uri == 'education'?'active': ''}}'>
      <i class="icon ion-ios-briefcase-outline"></i>
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
            @if ($message = Session::get('success'))
                       <div class="alert alert-success" id="errorcontainer">
                      <h3>{{$message}}</h3>
                          </div>
                              @endif

              <!-- Edit Work and Education
              ================================================= -->
              <div class="edit-profile-container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="block-title">
                  <h4 class="grey d-inline"><i class="icon ion-ios-book-outline"></i> Education</h4>
                  <div class="line"></div></div>
                     <div id="edu_form_container">
                                   </div>
               
   <div class="edu_form_container">
   <div class="table-responsive">
           <table class="table table-bordered">
             <tr>
             <th>#</th>
             <th>institute</th>
             <th>Session</th>
             <th>Level</th>
             <th>Major</th>
             <th>Graduated?</th>
             @if($user_information->id == Auth::user()->id)
             <th>Action</th>
             @endif
             </tr>
             @forelse($user_information->education as $education)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$education->institute}}</td>
                <td>{{$education->sess}}</td>
                <td>{{$education->level}}</td>
                <td>{{$education->major}}</td>
                <td>{{$education->graduate}}</td>
                    @if (Auth::check())
                            @if(count((array) $user_information->education) > 0)
                            @if($education->user->id == Auth::user()->id)
                            <td>
                            {!! Form::open(['url' => 'deleteEducation/'.$education->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment']) !!}
                            <button title="Delete info" class="fa fa-trash" onclick="return confirm('are sure you want to delete this info?')"></button>
                            {!! Form::close() !!}
                            </td>
                            @endif
                            @endif
                           @endif
              </tr>
        
             @empty
              <h5>No Education info found.</h5>
              
             @endforelse
             </table>
</div>
   </div>
    <div class="block-title">

                  <h4 class="grey d-inline"><i class="icon ion-ios-briefcase-outline"></i> Work Experiences</h4>
                  
                  <div class="line"></div>
                  
         </div>
         
    <div id="work_form_container">

               </div>
<div class="workrecord_container">
  <div id="work_form_container">
   <div class="table-responsive">
    @if (Auth::check())

                <table class="table table-bordered">
                   <tr>
                   <th>#</th>
                   <th>Comany</th>
                   <th>Designation</th>
                   <th>From</th>
                   <th>To</th>
                   <th>City/Town</th>
                   <th>Working?</th>
                   @if($user_information->id == Auth::user()->id)
                   <th>Action</th>
                   @endif
                   </tr>
                   @forelse($user_information->works as $works)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$works->company}}</td>
                      <td>{{$works->designation}}</td>
                      <td>{{$works->workfrom}}</td>
                      <td>{{$works->workto}}</td>
                      <td>{{$works->city}}</td>
                      <td>{{$works->working}}</td>
                                  @if(count((array) $user_information->works) > 0)
                                  @if($works->user->id == Auth::user()->id)
                                  <td>
                                  {!! Form::open(['url' => 'deleteWork/'.$works->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment']) !!}
                                  <button title="Delete info" class="fa fa-trash" onclick="return confirm('are sure you want to delete this info?')"></button>
                                  {!! Form::close() !!}
                                  </td>
                                  @endif
                                  @endif
                    </tr>
              
                   @empty
                    <h5>No Work info found.</h5>
                   @endforelse
                   </table>
        @endif
        </div>
      </div>
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
                    @if($activity->type == "post")
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You added a Post</a>
                    @else
                      @if($activity->user->id == $activity->post->user->id)
                        <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You {{ $activity->type }}ed on your Post</a>
                      @else
                       <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link">You {{ $activity->type }}ed on a Post</a>
                       <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? ucfirst($activity->post->user->profiles->f_name) : ucfirst($activity->post->user->name) }}</a>
                      @endif   
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
                       @if($activity->user->id == $activity->post->user->id)
                          <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on his Post</a>
                       @else
                         <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on a Post</a>
                         <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? ucfirst($activity->post->user->profiles->f_name) : ucfirst($activity->post->user->name) }}</a>
                       @endif   
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
        </div>


    <!-- Footer
    ================================================= -->
    @include('partials.footer')
  
    <!--preloader-->
    <!-- <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div> -->
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
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>     <script>
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
      
    }); 
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
<script> 
    $(document).ready(function(e){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });
        // ADD FRIEND ON BAR//
        $(".follow-me").on("click",".addFrndBtn",function(){
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
// ADD FRIEND ON BAR END//
    });
  </script>
    
  </body>
</html>
