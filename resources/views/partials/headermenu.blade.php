
 <!-- Header
    ================================================= -->
		<header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
          <a class="navbar-brand" href="{{url('/home')}}"><img class="my-2" src="{{asset('images/pp-icon.png')}}" alt="logo" height="40" width="80" style="position: absolute; top: 10%;"/></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            {!! Form::open(['url' => 'search','method' => 'get','class' => 'form-inline my-2 my-lg-0', 'style' => 'padding-left: 0px; position: absolute; left: 41%;']) !!}
                    <span class="form-control-icon mr-sm-2" style="" type=submit><i class="fa fa-search"></i></span> 
                    <input class="form-control mr-sm-3" type="search" placeholder="Search" name="search" aria-label="Search" style="border-radius: 25px;padding-left: 2.875rem;background-color: #10778a;border: 1px;"/>
                    {!! Form::close() !!}
  

          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown"><a href="{{url('/home')}}">Home</a></li>
              <li class="dropdown">
              <a class="dropdown-toggle" href="{{url('profiles/'.Auth::id())}}">{{ isset(Auth::user()->profiles->f_name) ? ucfirst(Auth::user()->profiles->f_name) : Auth::user()->name}}<span class="sr-only">(current)</span></a>
              </li>
              <li class="dropdown">
              <a class="dropdown-toggle" href="{{url("/chat")}}"><i class="fa fa-comments"></i></a>
              </li>
              <li class="dropdown">
              <a class="nav-link count-indicator dropdown-toggle" href="#" id="notificationDropdown"  data-toggle="dropdown">
                  <i class="fa fa-bell dropdown-toggle"><span class="count wb-unread-count indicator-badge">0</span></i>
                 
                </a>
                <div id="notificationDropdown" class="dropdown-menu dropdown-menu-right navbar-dropdown preview list drop" aria-labelledby="notificationDropdown">
                <a class="dropdown-item">
                 <p class="mb-0 font-weight-normal float-left text-info">You Have <span class="count" id="notecount">0</span> new notifications<span class="badge badge-pill badge-warning float-right" style="margin-left: 20px;" >Mark all as read</span></p>
                </a>
                <div class="dropdown-divider"></div>
                 <div id="noteItemContainer">
    
                 </div>
              </li>
              <li class="dropdown">
              
              <a class="nav-link dropdown dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      more
                                <span><i class="fa fa-caret-down"></i></span>
            
                    </a>
              <ul class="dropdown-menu page-list">
                <li>
                <a href="{{url('/activity')}}">Activity</a></li>
                <li><a href="{{url('/profiles')}}">Setting</a></li>
                <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                                                  onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                </li>
                
              </ul>
            </li>
           </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
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
