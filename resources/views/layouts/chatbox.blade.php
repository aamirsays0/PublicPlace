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
     .container{
       margin:auto;
      }
img{ max-width:100%;}
.inbox_people {
  background: #05728f none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
  color: #fff;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%
}

.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #ffff;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#fff9f9; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
}
.chat_ib {
  padding: 0 0 0 15px;
  width: 88%;
}
.chat-item-header {
    border-bottom: 1px dotted #caef8e;
    margin-bottom: 10px;
}
.chat_people{ overflow:hidden; clear:both;  
   cursor: pointer;
}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 471px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}
.active_chat div div h5{
   color: #05728f}

.received_withd_msg::before{
border-bottom: 10px solid transparent;
    border-right: 8px solid rgba(141,198,63, .1);
    border-top: 10px solid transparent;
    content: "";
    height: 0;
    left: -8px;
    position: absolute;
    top: 11%;
    left: 44.5%;
    width: 0;
}
.received_msg {
  vertical-align: top;
  width: 92%;
  margin: 10px 0 10px 0;
 }
 .received_withd_msg p {
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;
  background: rgba(141,198,63, .1);
    margin-left: 50px;
    padding: 5px 10px;
    border-radius: 10px;
}
.mesgs {
  float: left;
  width: 60%;
}

 .sent_msg p {
  background: rgb(233 246 252) none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0;
  color: #000;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:10px 0 10px;}
.sent_msg {
  float: right;
  width: 46%;
  width: 57%;
    background: rgb(233 246 252);
    margin-left: 50px;
    padding: 5px 10px;
    border-radius: 10px;
    margin: 10px 0 10px 0;

}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 420px;
  overflow-y: auto;
  color: #fff;
}

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
    @yield('script')

    
  <script>
    $(document).ready(function() {
        $('.count-indicator').on('click', function() {
            $.ajax({
                method: "DELETE",
                url:"{{ route('notification.destroy', auth()->id()) }}",
                success: function(res) {
                  parseInt($("#notificationDropdown span.count").text("0"));
                },
                error: function(err) {
                  console.log(err)
                }
        
              });
        })
    })
  </script>
  </body>
</html>
