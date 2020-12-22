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
        <div class="timeline-cover" style="background-image: url('{{asset('storage/profile/'.Auth::id().'_cover.jpg')}} ')">

          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                  <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="img-responsive profile-photo">
                  <h3>{{Auth::user()->name}}</h3>
                  <p class="text-muted">Creative Director</p>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="timeline.html">Timeline</a></li>
                  <li><a href="timeline-about.html" class="active">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="timeline-friends.html">Friends</a></li>
                </ul>
                <ul class="follow-me list-inline">
                  <li>1,299 people following her</li>
                  <li><button class="btn-primary">Add Friend</button></li>
                </ul>
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
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
          </div><!--Timeline Menu for Small Screens End-->

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
                <div class="block-title">
                  <h4 class="grey d-inline"><i class="icon ion-ios-book-outline"></i>My education</h4>
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
     <th>Desc</th>
     <th>Action</th>
     </tr>
     @forelse($userinfo->education as $education)
      <tr>
        <td>{{$loop->index}}</td>
        <td>{{$education->institute}}</td>
        <td>{{$education->sess}}</td>
        <td>{{$education->level}}</td>
        <td>{{$education->major}}</td>
        <td>{{$education->description}}</td>
        <td><a href="#"><span class="fa fa-edit"></span> </a>
        <a href="#"><span class="fa fa-trash"></span></a></td>
      </tr>

     @empty
      <tr><td><h3>No info found. Add some education info</h3></td></tr>
      
     @endforelse
     </table>


   </div>
    <div class="block-title">

                  <h4 class="grey d-inline"><i class="icon ion-ios-briefcase-outline"></i>Work Experiences</h4>
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
     <th>Desc</th>
     <th>Action</th>
     </tr>
     @forelse($userinfo->works as $works)
      <tr>
        <td>{{$loop->index}}</td>
        <td>{{$works->company}}</td>
        <td>{{$works->designation}}</td>
        <td>{{$works->workfrom}}</td>
        <td>{{$works->workto}}</td>
        <td>{{$works->city}}</td>
        <td>{{$works->description}}</td>
        <td>{{$works->working}}</td>
        <td><a href="#"><span class="fa fa-edit"></span> </a>
        <a href="#"><span class="fa fa-trash"></span></a></td>
      </tr>

     @empty
      <tr><td><h3>No info found. Add some education info</h3></td></tr>
      
     @endforelse
     </table>
         </div>
               </div>
            </div>
            </div>
            <div class="col-md-2 staticactivity" style="width: 224px;">

<div id="sticky-sidebar">
<h4 class="grey">Your Activity</h4>
 <div class="feed-item"> 
 <div class="live-activity">
  <?php
   $olddate = "";
   $newdate = "";
   $first = true;
   $content = "";
   foreach($allActivity as $singleActivity){
     $newdate = $singleActivity->created_at->format('Y-m-d');
     if($first){
         $olddate = $singleActivity->created_at->format('Y-m-d');
     }
     if($olddate === $newdate){
         if($first == true){
             $first = false;
             $content .="<p class='text-muted'>".$newdate."</p>";
         }
         $content .= \App\Custom\Activity::getview($singleActivity);
     }
     else{
         $content .="</div>";
         $content .="<p class='text-muted'>".$newdate."</p>";
         $content .= \App\Custom\Activity::getview($singleActivity);
     }
     $olddate = $newdate;
   }
   echo $content."</div>";
   ?>
   </div>
   {{$allActivity->links()}}
   </div>
   </div></div>
   </div>


    <!-- Footer
    ================================================= -->
    <footer id="footer">
      <div class="container">
      	<div class="row">
          <div class="footer-wrapper">
            <div class="col-md-3 col-sm-3">
              <a href=""><img src="images/logo-black.png" alt="" class="footer-logo"></a>
              <ul class="list-inline social-icons">
              	<li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>For individuals</h5>
              <ul class="footer-links">
                <li><a href="">Signup</a></li>
                <li><a href="">login</a></li>
                <li><a href="">Explore</a></li>
                <li><a href="">Finder app</a></li>
                <li><a href="">Features</a></li>
                <li><a href="">Language settings</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>For businesses</h5>
              <ul class="footer-links">
                <li><a href="">Business signup</a></li>
                <li><a href="">Business login</a></li>
                <li><a href="">Benefits</a></li>
                <li><a href="">Resources</a></li>
                <li><a href="">Advertise</a></li>
                <li><a href="">Setup</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>About</h5>
              <ul class="footer-links">
                <li><a href="">About us</a></li>
                <li><a href="">Contact us</a></li>
                <li><a href="">Privacy Policy</a></li>
                <li><a href="">Terms</a></li>
                <li><a href="">Help</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-3">
              <h5>Contact Us</h5>
              <ul class="contact">
                <li><i class="icon ion-ios-telephone-outline"></i>+1 (234) 222 0754</li>
                <li><i class="icon ion-ios-email-outline"></i>info@thunder-team.com</li>
                <li><i class="icon ion-ios-location-outline"></i>228 Park Ave S NY, USA</li>
              </ul>
            </div>
          </div>
      	</div>
      </div>
      <div class="copyright">
        <p>Thunder Team © 2016. All rights reserved</p>
      </div>
		</footer>
      
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    
    <!--Buy button-->
    <a href="https://themeforest.net/cart/add_items?item_ids=18711273&ref=thunder-team" target="_blank" class="btn btn-buy"><span class="italy">Buy with:</span><img src="images/envato_logo.png" alt=""><span class="price">Only $20!</span></a>

    <!-- Scripts
    ================================================= -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky-kit.min.js"></script>
    <script src="js/jquery.scrollbar.min.js"></script>
    <script src="js/script.js"></script>
    <script src="http://unpkg.com/ionicons@4.4.2/dist/ionicons.js"></script>
    <script>
    $(document).ready(function(){
      $("#edu_form_container").hide();
      $("#edu_toggle_btn").click(function(){
        $("#edu_form_container").toggle(200);

      });
      $("#work_form_container").hide();
      $("#work_toggle_btn").click(function(){
        $("#work_form_container").toggle(200);

      });

    }); 
    </script>

    
    
  </body>
<!-- Copied from http://mythemestore.com/friend-finder/edit-profile-work-edu.html by Cyotek WebCopy 1.7.0.600, Thursday, September 5, 2019, 12:34:06 AM -->
</html>
