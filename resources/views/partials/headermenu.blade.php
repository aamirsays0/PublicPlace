<link rel="stylesheet" href="{{asset('css/headerNewStyles.css')}}">

<!-- Header
    ================================================= -->
    <header id="header">
    <div class="fixed-top">
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
<!--         <a class="navbar-brand" href="index.html"><img src="images/pp-icon.png" alt="logo" height="30" width="80"/></a>
 -->        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{__('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
         </button> -->
         <div class="col-md-2 logo-icon">
      <img class="my-2" src="images/pp-icon.png" alt="logo" height="40" width="80"/>
    </div>
    <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form> -->
    {!! Form::open(['url' => 'search','method' => 'get','class' => 'form-inline my-2 my-lg-0', 'style' => 'padding-left: 0px;
']) !!}
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
<!--                     <button class="btn btn-danger fa fa-search"></button>
 -->                    {!! Form::close() !!}

    <ul class="navbar-nav list-inline list-unstyled ml-auto" style="text-align: right">
      <li class="nav-item dropdown">

<a class="nav-link dropdown" href="{{url("/home")}}">Home</a>
      </li>
      
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown" href="{{url('profiles/'.Auth::id())}}">{{Auth::user()->name}}<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">

<a class="nav-link dropdown" href="{{url("/chat")}}"><i class="fa fa-comments"></i></a>
      </li>
      <li class="nav-item dropdown">
       <a class="nav-link count-indicator dropdown-toggle" href="#" id="notificationDropdown"  data-toggle="dropdown">
       <i class="fa fa-bell"></i>
        <span class="count wb-unread-count indicator-badge">0</span>
        </a>
   <div id="notificationContainer" class="dropdown-menu dropdown-menu-right navbar-dropdown preview list drop" aria-labelledby="notificationDropdown">
         <a class="dropdown-item">
          <p class="mb-0 font-weight-normal float-left text-info">You Have <span id="notecount">0</span> new notifications<span class="badge badge-pill badge-warning float-right" style="margin-left: 20px;" >Mark all as read</span></p>
         </a>
          <div class="dropdown-divider">
          <div id="noteItemContainer">
          
               </div>
         
        

      </li>
      <li class="nav-item dropdown list-inline list-unstyled dropdown">
        <a class="nav-link dropdown dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          more
                    <span><img src="images/down-arrow.png" alt="" /></span>

        </a>
        <div class="dropdown-menu drop" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{url('/activity')}}">Activity</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{url('/profiles')}}">Setting</a>
          <div class="dropdown-divider"></div>
      
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                            </div>
      </li>
      </div> 
    </ul>
     </div>

 </nav>
 </div>
    </header>
    <!--Header End-->
    
<!-- <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

         <!- Brand and toggle get grouped for better mobile display ->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img src="images/pp-icon.png" alt="logo" height="30" width="80"/></a>
          </div>

          <!- Collect the nav links, forms, and other content for toggling ->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav float-right list-inline list-unstyled main-menu">
              
              <li class="nav-item dropdown list-inline-item dropdown">
              <a href="index.html" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home<span><img src="images/down-arrow.png" alt=""/></span></a></li>
              <li class="nav-item dropdown list-inline-item dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Newsfeed <span><img src="images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu list-inline list-unstyled newsfeed-home">
                    <li><a href="newsfeed.html" class="nav-link">Newsfeed</a></li>
                    <li><a href="newsfeed-people-nearby.html" class="nav-link">Poeple Nearly</a></li>
                    <li><a href="newsfeed-friends.html" class="nav-link">My friends</a></li>
                    <li><a href="newsfeed-messages.html" class="nav-link">Chatroom</a></li>
                    <li><a href="newsfeed-images.html" class="nav-link">Images</a></li>
                    <li><a href="newsfeed-videos.html" class="nav-link">Videos</a></li>
                  </ul>
              </li>
              <li class="nav-item dropdown list-inline list-unstyled dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timeline <span><img src="images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu list-inline list-unstyled login">
                  <li><a href="timeline.html" class="nav-link">Timeline</a></li>
                  <li><a href="timeline-about.html" class="nav-link">Timeline About</a></li>
                  <li><a href="timeline-album.html" class="nav-link">Timeline Album</a></li>
                  <li><a href="timeline-friends.html" class="nav-link">Timeline Friends</a></li>
                  <li><a href="edit-profile-basic.html" class="nav-link">Edit: Basic info</a></li>
                  <li><a href="edit-profile-work-edu.html" class="nav-link">Edit: Work</a></li>
                  <li><a href="edit-profile-interests.html" class="nav-link">Edit: interests</a></li>
                  <li><a href="edit-profile-settings.html" class="nav-link">Account settings</a></li>
                  <li><a href="edit-profile-password.html" class="nav-link">Change passwords</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown list-inline-item dropdown">
                <a href="#" class="dropdown-toggle pages" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All Pages <span><img src="images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu list-inline list-unstyled">
                  <li><a href="index.html" class="nav-link">Landing Page</a></li>
                  <li><a href="newsfeed.html" class="nav-link">Newsfeed</a></li>
                  <li><a href="newsfeed-people-nearby.html" class="nav-link">Poeple Nearly</a></li>
                  <li><a href="newsfeed-friends.html" class="nav-link">My friends</a></li>
                  <li><a href="newsfeed-messages.html" class="nav-link">Chatroom</a></li>
                  <li><a href="newsfeed-images.html" class="nav-link">Images</a></li>
                  <li><a href="newsfeed-videos.html" class="nav-link">Videos</a></li>
                  <li><a href="timeline.html" class="nav-link">Timeline</a></li>
                  <li><a href="timeline-about.html" class="nav-link">Timeline About</a></li>
                  <li><a href="timeline-album.html" class="nav-link">Timeline Album</a></li>
                  <li><a href="timeline-friends.html" class="nav-link">Timeline Friends</a></li>
                  <li><a href="contact.html" class="nav-link">Contact Us</a></li>
                </ul>
              </li>
              <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search friends, photos, videos">
              </div>
            </form>
              <li class="nav-item dropdown list-inline-item">
              <!-<a href="contact.html">Contact</a>->
              <a class="nav-link text-white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                            </div>
              </li>
            </ul>
             
          </div><!- /.navbar-collapse ->
        </div><!- /.container ->
      </nav> -->

