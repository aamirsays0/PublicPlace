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
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png">
	</head>
  <body>
  <style>
  input[type=file]{
    display: block;
  }
  .navbar-nav {
    float: left;
    margin-top: 20px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
}
.form-inline{
  float: left;
    margin-top: 15px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    padding-left: 550px;

}

</style>
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
              
              <!--Edit Profile Menu-->
              <ul class="edit-menu " style="margin-top: 80px">
                <li class='{{Route::current()->uri == 'profile'?'active': ''}}'><i class="icon ion-ios-information-outline"></i><a href="{{url('profile')}}">Basic Information</a></li>
              	<li class='{{Route::current()->uri == 'education'?'active': ''}}'><i class="icon ion-ios-briefcase-outline"></i><a href="{{url('education')}}">Education and Work</a></li>
              	<li class='{{Route::current()->uri == 'interest'?'active': ''}}'><i class="icon ion-ios-heart-outline"></i><a href="{{url('interest')}}">My Interests</a></li>
                <li><i class="icon ion-ios-settings"></i><a href="edit-profile-settings.html">Account Settings</a></li>
              	<li><i class="icon ion-ios-locked-outline"></i><a href="edit-profile-password.html">Change Password</a></li>
              </ul>
            </div>

            <div class="col-md-7">

<!-- Edit Interests
================================================= -->
<div class="edit-profile-container">
  <div class="block-title">
    <h4 class="grey"><i class="icon ion-ios-heart-outline"></i>My Interests</h4>
    <div class="line"></div>
    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
    <div class="line"></div>
  </div>
  <div class="edit-block">
    <ul class="list-inline interests">
        <li><a href=""><i class="icon ion-android-bicycle"></i> Bycicle</a></li>
        <li><a href=""><i class="icon ion-ios-camera"></i> Photgraphy</a></li>
        <li><a href=""><i class="icon ion-android-cart"></i> Shopping</a></li>
        <li><a href=""><i class="icon ion-android-plane"></i> Traveling</a></li>
        <li><a href=""><i class="icon ion-android-restaurant"></i> Eating</a></li>
    </ul>
    <div class="line"></div>
    <div class="row">
      <p class="custom-label"><strong>Add interests</strong></p>
      <div class="form-group col-sm-8">
        <input id="add-interest" class="form-control input-group-lg" type="text" name="interest" title="Choose Interest" placeholder="Interests. For example, photography">
      </div>
      <div class="form-group col-sm-4">
        <button class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
</div>

  <div class="col-md-2 static">
              
              <!--Sticky Timeline Activity Sidebar-->
    <div id="sticky-sidebar">
                <h4 class="grey">Sarah's activity</h4>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Commended on a Photo</p>
                    <p class="text-muted">5 mins ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Has posted a photo</p>
                    <p class="text-muted">an hour ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Liked her friend's post</p>
                    <p class="text-muted">4 hours ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> has shared an album</p>
                    <p class="text-muted">a day ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Footer
    ================================================= -->
      
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
    
    
  </body>
<!-- Copied from http://mythemestore.com/friend-finder/edit-profile-work-edu.html by Cyotek WebCopy 1.7.0.600, Thursday, September 5, 2019, 12:34:06 AM -->
</html>
