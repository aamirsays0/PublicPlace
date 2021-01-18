<link rel="stylesheet" href="{{asset('css/headerNewStyles.css')}}">
<style>
.dropdown-menu {
  
  background: #044c59;
    display: none;
    position: absolute;
    min-width: 120px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}
</style>
<!-- Header
    ================================================= -->
    <header id="header" class="stickyheader">
    <div class="fixed-top">
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
 
      <div class="col-md-2 logo-icon">
      <img class="my-2" src="{{asset('images/pp-icon.png')}}" alt="logo" height="40" width="80"/>
      </div>
    <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form> -->
    {!! Form::open(['url' => 'search','method' => 'get','class' => 'form-inline my-2 my-lg-0', 'style' => 'padding-left: 0px;
']) !!}
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
                    <button class="form-control mr-sm-2" type=submit><i class="fa fa-search"></i></button> 
                    {!! Form::close() !!}

    <ul class="navbar-nav list-inline list-unstyled ml-auto" style="text-align: right">
      <li class="nav-item dropdown">

<a class="nav-link dropdown" href="{{url("/home")}}">Home</a>
      </li>
      
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown" href="{{url('profiles/'.Auth::id())}}">{{ isset(Auth::user()->profiles->f_name) ? ucfirst(Auth::user()->profiles->f_name) : Auth::user()->name}}<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">

<a class="nav-link dropdown" href="{{url("/chat")}}"><i class="fa fa-comments"></i></a>
      </li>
      <li class="nav-item dropdown">
       <a class="nav-link count-indicator dropdown-toggle" href="#" id="notificationDropdown"  data-toggle="dropdown">
       <i class="fa fa-bell"></i>
        <span class="count wb-unread-count indicator-badge">0</span>
        </a>
   <div id="notificationDropdown" class="dropdown-menu dropdown-menu-right navbar-dropdown preview list drop" style="width: 240px;left: -50%;" aria-labelledby="notificationDropdown">
         <a class="dropdown-item">
          <p class="mb-0 font-weight-normal float-left text-info">You Have <span class="count" id="notecount">0</span> new notifications<span class="badge badge-pill badge-warning float-right" style="margin-left: 20px;" >Mark all as read</span></p>
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
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
