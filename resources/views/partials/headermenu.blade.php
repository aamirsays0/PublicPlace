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
.form-control-icon{
  position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    top: 17%;
    left: 2%;
    color: #e8e3dd;
    font-size: 1.4rem;
}
</style>
<!-- Header
    ================================================= -->
    <header id="header" class="stickyheader">   
      <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
 
      <div class="navbar-header">
        <a class="navbar-brand" href="{{url('/home')}}">
          <img class="my-2" src="{{asset('images/pp-icon.png')}}" alt="logo" height="40" width="80"style="position: absolute;left: 10%;bottom: 10%;"/>
         </a>
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
      </div>
      <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
           <!-- <form class="form-inline my-2 my-lg-0">
             <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
           </form> -->
          {!! Form::open(['url' => 'search','method' => 'get','class' => 'form-inline my-2 my-lg-0', 'style' => 'padding-left: 0px;']) !!}
                    <span class="form-control-icon mr-sm-2" style="" type=submit><i class="fa fa-search"></i></span> 
                    <input class="form-control mr-sm-3" type="search" placeholder="Search" name="search" aria-label="Search" style="border-radius: 25px;padding-left: 2.875rem;background-color: #10778a;border: 1px;"/>
                    {!! Form::close() !!}

         <ul class="navbar-nav list-inline list-unstyled ml-auto" style="text-align: right">
           <li class="nav-item dropdown">            
             <a class="nav-link dropdown" href="{{url('/home')}}">Home</a>
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
                <div id="notificationDropdown" class="dropdown-menu dropdown-menu-right navbar-dropdown preview list drop" style="width: 240px;left: -100%;" aria-labelledby="notificationDropdown">
                <a class="dropdown-item">
                 <p class="mb-0 font-weight-normal float-left text-info">You Have <span class="count" id="notecount">0</span> new notifications<span class="badge badge-pill badge-warning float-right" style="margin-left: 20px;" >Mark all as read</span></p>
                </a>
                <div class="dropdown-divider"></div>
                 <div id="noteItemContainer">
    
                 </div>
           </li>
           <li class="nav-item dropdown list-inline list-unstyled dropdown">
                    <a class="nav-link dropdown dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      more
                                <span><i class="fa fa-caret-down"></i></span>
            
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
        </ul>
     </div>

    </nav>
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
