<!-- Positions: head, style,sidebar-left,content,sidebar-right
 -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network " />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
    <meta name="robots" content="index, follow" />

		<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>   
    <link rel="stylesheet" href="{{asset('css/lightbox.min.css')}}" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('css/emoji.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/headerNewStyles.css')}}"/>

    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('images/fav.png')}}"/>
    @stack('head')
   <style>
      @stack('style')

    </style>	
</head>
  <body>

@include('partials.headermenu')

    <div id="page-contents" class="mt-5">
    	<div class="container">
    		<div class="row">

          <!-- Newsfeed Common Side Bar Left
          ================================================= -->
    	  <div class="col-md-3 static">
          @section('sidebar-left')
            this is master bar

            @show

          </div>
    	  <div class="col-md-7" id="contentpostContainer">

          @section('content')
            this is master bar

          @show

          </div>

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
    	     <div class="col-md-2 static">
             @section('sidebar-right')
              this is master sidebar

              @show
        </div>
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
    <script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/lightbox.min.js')}}"></script>
    <script src="{{asset('js/jquery.jscroll.min.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="http://unpkg.com/ionicons@4.4.2/dist/ionicons.js"></script>
  	<script src="{{asset('js/jquery.validate.min.js')}}"></script>
    /* Sweet alert CDN */
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('script')
    @include('sweetalert::alert')

    </script>

    
  </body>
</html>
