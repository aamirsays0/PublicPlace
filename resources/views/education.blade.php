<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Copied from http://mythemestore.com/friend-finder/edit-profile-work-edu.html by Cyotek WebCopy 1.7.0.600, Thursday, September 5, 2019, 12:34:06 AM -->
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
                  <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="img-responsive profile-photo">
                  <h4>{{isset($userinfo->profiles->f_name , $userinfo->profiles->l_name) ? $userinfo->profiles->f_name.' '.$userinfo->profiles->l_name : $userinfo->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$userinfo->id)}}">Timeline</a></li>
                  <li><a href="timeline-about.html">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="{{url('friends/'.$userinfo->id)}}">Friends</a></li>
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
              
            @include('partials.profilemenu')

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
                  <h4 class="grey d-inline"><i class="icon ion-ios-book-outline"></i> My education</h4>
                  <button class="btn btn-primary pull-right" id="edu_toggle_btn">+</button>
                  <div class="line"></div>
                  <div class="line"></div></div>
                     <div id="edu_form_container">
         <div class="edit-block">
                           {!! Form::open([
                         'url' => 'education',
                              'class'=>'form'
                                  ]) !!}            
                  <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="school">My Institute</label>
                        <input id="school" class="form-control input-group-lg" type="text" name="institute" title="Enter institute" placeholder="My institute" value="Harvard Unversity">
                        </div>
                       </div>
                 <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="date-from">Sess</label>
                        <input id="date-from" class="form-control input-group-lg" type="text" name="sess" title="Enter a Date" placeholder="year-year" value="2012-2016">
                      </div>
                      
                    </div>
                  <div class="row">
                  <div class="form-group col-xs-6">
                         <label for="level" class="">level</label>
                       <!--<input id="date-from" class="form-control" type="text" name="major" title="Enter major subject" placeholder="major" value="Science">-->
                                  {!! Form::select('level', ['ssc'=>'SSC',
                                     'diploma'=>'Diploma',
                                        'o level'=>'O level',
                                          'phd'=>'Phd',
                                           'bachelor'=>'Bachelor',
                                             'master'=>'Masters',
                                               'other'=>'Other'], null, ['id'=>'level','class'=>'form-control','placeholder' => 'Pick a size...']) !!}


                               </div>

                         <div class="form-group col-xs-6">
                             <label for="date-from" class="">Major</label>
                             <input id="date-from" class="form-control" type="text" name="major" title="Enter major subject" placeholder="major" value="Science">
                          </div>
                            </div>
                   
                    <div class="row">
                         <div class="form-group col-xs-12">
                           <label for="edu-description">Description</label>
                           <textarea id="edu-description" name="description" class="form-control" placeholder="Some texts about my education" rows="4" cols="400"></textarea>
                          </div>
                         </div>
                    <div class="row">
                         <div class="form-group col-xs-12">
                           <label for="graduate">Graduated?:-</label>
                           <input id="graduate" type="checkbox" name="graduate" value="graduate" checked=""> Yes!! 
                          </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                               {!! Form::close() !!}
                                   </div>
                                   </div>
               
   <div class="edu_form_container">
   <table class="table table-bordered">
     <tr>
     <th>#</th>
     <th>institute</th>
     <th>Session</th>
     <th>Level</th>
     <th>Major</th>
     <th>Action</th>
     </tr>
     @forelse($userinfo->education as $education)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$education->institute}}</td>
        <td>{{$education->sess}}</td>
        <td>{{$education->level}}</td>
        <td>{{$education->major}}</td>
        <td>{{$education->graduate}}</td>
        <td><a href="#"><span class="fa fa-edit"></span> </a>
            @if (Auth::check())
                    @if(count((array) $userinfo->education) > 0)
                    @if($education->user->id == Auth::user()->id)
                    {!! Form::open(['url' => 'deleteEducation/'.$education->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment']) !!}
                    <button title="Delete info" class="fa fa-trash" onclick="return confirm('are sure you want to delete this info?')"></button>
                    {!! Form::close() !!}
                    @endif
                    @endif
                   @endif</td>
      </tr>

     @empty
      <tr><td><h5>No info found. Add some education info</h5></td></tr>
      
     @endforelse
     </table>


   </div>
    <div class="block-title">

                  <h4 class="grey d-inline"><i class="icon ion-ios-briefcase-outline"></i> Work Experiences</h4>
                  <button class="btn btn-primary pull-right" id="work_toggle_btn">+</button>
                  <div class="line"></div>
                  <div class="line"></div>
                  
         </div>
         
    <div id="work_form_container">

           <div class="edit-block">
                          {!! Form::open([
                         'url' => 'work',
                              'class'=>'form'
                                  ]) !!}
                          <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="company">Company</label>
                        <input id="company" class="form-control input-group-lg" type="text" name="company" title="Enter Company" placeholder="Company name" value="Envato Inc">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="designation">Designation</label>
                        <input id="designation" class="form-control input-group-lg" type="text" name="designation" title="Enter designation" placeholder="designation name" value="Exclusive Author">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="from-date">From</label>
                        <input id="from-date" class="form-control input-group-lg" type="date" name="date" title="Enter a Date" placeholder="from" value="01-01-2000">
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="to-date" class="">To</label>
                        <input id="to-date" class="form-control input-group-lg" type="date" name="date" title="Enter a Date" placeholder="to" value="01-01-2000">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="work-city">City/Town</label>
                        <input id="work-city" class="form-control input-group-lg" type="text" name="city" title="Enter city" placeholder="Your city" value="Melbourne">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="work-description">Description</label>
                        <textarea id="work-description" name="description" class="form-control" placeholder="Some texts about my work" rows="4" cols="400">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</textarea>
                      </div>
                    </div>
                    <div class="row">
                         <div class="form-group col-xs-12">
                           <label for="working">Working?:-</label>
                           <input id="working" type="checkbox" name="working" value="working" checked=""> Yes!! 
                          </div>
                          </div>
                    <button class="btn btn-primary">Save Changes</button>
                    {!! Form::close() !!}
                </div>
               </div>
<div class="workrecord_container">
  <div id="work_form_container">
   <table class="table table-bordered">
     <tr>
     <th>#</th>
     <th>Comany</th>
     <th>Designation</th>
     <th>From</th>
     <th>To</th>
     <th>City/Town</th>
     <th>Action</th>
     </tr>
     @forelse($userinfo->works as $works)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$works->company}}</td>
        <td>{{$works->designation}}</td>
        <td>{{$works->workfrom}}</td>
        <td>{{$works->workto}}</td>
        <td>{{$works->city}}</td>
        <td>{{$works->working}}</td>
        <td><a href="#"><span class="fa fa-edit"></span> </a>
        @if (Auth::check())
                    @if(count((array) $userinfo->works) > 0)
                    @if($works->user->id == Auth::user()->id)
                    {!! Form::open(['url' => 'deleteWork/'.$works->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment']) !!}
                    <button title="Delete info" class="fa fa-trash" onclick="return confirm('are sure you want to delete this info?')"></button>
                    {!! Form::close() !!}
                    @endif
                    @endif
                   @endif</td>
      </tr>

     @empty
      <h5>No info found. Add some work info</h5>
     @endforelse
     </table>
         </div>
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
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link">You {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ $activity->post->user->name }}</a>
                  </p>
                  <p class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                </div>
              </div>
            @endforeach          
          </div>
        </div>   </div>


    <!-- Footer
    ================================================= -->
    @include('partials.footer')
  
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    <!-- Scripts
    ================================================= -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky-kit.min.js"></script>
    <script src="js/jquery.scrollbar.min.js"></script>
    <script src="js/script.js"></script>
    <script src="{{asset('js/lightbox.min.js')}}"></script>
    <script src="http://unpkg.com/ionicons@4.4.2/dist/ionicons.js"></script>
    <script>
    $(document).ready(function(e){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });
 
    $(document).ready(function(){
      $("#edu_form_container").hide();
      $("#edu_toggle_btn").click(function(){
        $("#edu_form_container").toggle(200);

      });
      $("#work_form_container").hide();
      $("#work_toggle_btn").click(function(){
        $("#work_form_container").toggle(200);

      });
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
  }); 
    </script>

    
    
  </body>
</html>
