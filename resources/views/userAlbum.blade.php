<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Copied from http://mythemestore.com/friend-finder/edit-profile-basic.html by Cyotek WebCopy 1.7.0.600, Thursday, September 5, 2019, 12:34:06 AM -->
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
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/style.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/headerNewStyles.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/lightbox.min.css')}}" />

    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('images/fav.png')}}">
    
  </head>
  <body>
  

@include('partials.headermenu')
    <div class="container">

      <!-- Timeline
      ================================================= -->
       <div class="timeline">
      <div class="timeline-cover" style="background-image: url('{{asset('storage/profile/'.$user_information->id.'_cover.jpg')}} ')"  data-lightbox="cp">
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
                    <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-responsive profile-photo"/>
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo" id="uploadImage" alt="">
                   @endif
                   </a>
                  <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$user_information->id)}}" class="active">Timeline</a></li>
                  <li><a href="timeline-about.html">About</a></li>
                  <li><a href="{{route('user.album.show',$user_information->id)}}">Album</a></li>
                  <li><a href="{{url('allfriends/'.$user_information->id)}}">Friends</a></li>
                </ul>
                
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
            @if (file_exists(public_path('storage/profile/'.$user_information->id.'_profile.jpg')) )
                    <a href="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" data-lightbox="pp">
                    <img src="{{asset('storage/profile/'.$user_information->id.'_profile.jpg')}}" alt="" class="img-responsive profile-photo"/>
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="img-responsive profile-photo" id="uploadImage" alt="">
                   @endif
                   </a>
                   <h4>{{isset($user_information->profiles->f_name , $user_information->profiles->l_name) ? $user_information->profiles->f_name.' '.$user_information->profiles->l_name : $user_information->name}}</h4>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                  <li><a href="{{url('profiles/'.$user_information->id)}}" class="active">Timeline</a></li>
                  <li><a href="timeline-about.html">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="{{url('friends/'.$user_information->id)}}">Friends</a></li>
              </ul>
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
           <img class="img-fluid" id="modal_image_container" src="" alt="">
         </div>
     </div>
  </div>
</div>
      <div id="page-contents">
          <div class="row">
            <div class="col-md-3">
              
      
        <!--Edit Profile Menu-->
        <ul class="edit-menu " style="margin-top: 80px">
    <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
      <i class="icon ion-ios-information-outline"></i>
      @if ( isset($user_information) && $user_information->id === Auth::id())
      <a href="{{url('profiles')}}">Edit Basic Information</a>
      @else
      <a href="{{ route('view.friends.profile', $user_information->id) }}">  Basic Information</a>
      @endif
    </li><br>
    <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'>
      @if ( isset($user_information) && $user_information->id === Auth::id())
      <i class="icon ion-ios-information-outline"></i>
      <a href="{{ route('view.friends.profile', $user_information->id) }}">Basic Information</a>
       @endif
    </li><br>
      <li class='{{Route::current()->uri == 'education'?'active': ''}}'><i class="icon ion-ios-briefcase-outline"></i>
      @if ( isset($user_information) && $user_information->id === Auth::id())
      <a href="{{url('education')}}"> Education & Work</a>
      @else
      <a href="{{ route('view.friends.education', $user_information->id) }}">  Education & Work</a>
      @endif  
            </li><br>

      <li class='{{Route::current()->uri == 'update'?'active': ''}}'>
      @if ( isset($user_information) && $user_information->id === Auth::id())
      <i class="icon ion-ios-locked-outline"></i>
        <a href="{{url('change-password')}}">  Change Password</a>
        @endif
        </li>

  </ul>            </div>
            <div class="col-md-7" style="padding-right: 30px;">

            
<!-- tabs start-->
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">People</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Posts</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  <div id="home" class="tab-content tab-pane active"><br>
  <div class="scroll">
                   <!-- Media
            ================================================= -->

            <div class="media">
            	<div class="row js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": true }'>
                @foreach($images as $img)
                 <div class="grid-item col-md-6 col-sm-6">
            			<div class="media-grid">
                  <a href="{{route('posts.show',$img->post_id)}}">
                    <div class="img-wrapper">
                        <img src="{{url('/storage/postimages/'.$img->imgname)}}" style="height: 200px;width: 311px;"/>
                    </div>        
                  </a>              
                  </div>
            		</div>
                @endforeach 
            	</div>
            </div>
            </div>    
  </div>
  <div id="menu1" class="tab-content tab-pane"><br>
  <div class="row">
    @foreach($videos as $vid)
      <div class="col-sm-12 col-md-6">
        <video style="width: 100%;height: 150px;border-radius: 15px;" controls>
          <!-- {{$vid->vidname}} -->
          <source src="{{ asset('storage/postvideos/'.$vid->vidname) }}" type="video/mp4">
           Your browser does not support the video tag.
        </video>
      </div>
    @endforeach  
  </div>
  </div>
<!-- tabs end -->
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
                  <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> You {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? $activity->post->user->profiles->f_name : $activity->post->user->name }}</a>
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
                    <a href="{{ route('posts.show', $activity->post->id) }}" class="profile-link" style="text-transform: capitalize"> {{ isset($activity->user->profiles->f_name) ? ucfirst($activity->user->profiles->f_name) : ucfirst($activity->user->name) }} {{ $activity->type }}ed on a Post</a>
                    <a href="{{ route('profiles.show', $activity->post->user->id) }}"> by {{ isset($activity->post->user->profiles->f_name) ? $activity->post->user->profiles->f_name : $activity->post->user->name }}</a>
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
                


<?php
// $olddate = "";
// $newdate = "";
// $first = true;
// $content = "";
// foreach($allActivity as $singleActivity){
//   $newdate = $singleActivity->created_at->format('Y-m-d');
//   if($first){
//       $olddate = $singleActivity->created_at->format('Y-m-d');
//   }
//   if($olddate === $newdate){
//       if($first == true){
//           $first = false;
//           $content .="<p class='text-muted'>".$newdate."</p>";
//       }
//       $content .= \App\Custom\Activity::getview($singleActivity);
//   }
//   else{
//       $content .="";
//       $content .="<p class='text-muted'>".$newdate."</p>";
//       $content .= \App\Custom\Activity::getview($singleActivity);
//   }
//   $olddate = $newdate;
// }
// echo $content;
?>

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
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/lightbox.min.js')}}"></script>
    <script src="{{asset('js/jquery.jscroll.min.js')}}"></script>
    <script src="http://unpkg.com/ionicons@4.4.2/dist/ionicons.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Sweet alert CDN -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
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
      })
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
    var form_data = new FormData();
 
var storedFiles = [];
    $(document).ready(function(e){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });
 
//JSCROLL
            //  $("ul.pagination").hide();
            //  $('.scroll').jscroll({
            //    autoTrigger: true,
            //    nextSelector : '.pagination li.active + li a',
            //    contentSelector: 'div.scroll',
            //    callback: function(){
            //      $('ul.pagination:visible:first').hide();
            //    }

            //  });
//SCROLL ends

      /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES*/
    $(document).on('change', '#post-images',function(){
      $('.preview').html("");
      len_files = $("#post-images").prop("files").length;
      var construc = "<div class='row'>";
      for (var i = 0; i < len_files; i++){
        var file_data = $("#post-images").prop("files")[i];
        form_data.append("photos[]", file_data);
        construc += '<div class="col-3"><span class="btn btn-sm btn-danger imageremove">&times;</span><img width="120px" height="120px" src="' + window.URL.createObjectURL(file_data) + '"alt="' + file_data.name + '"/></div>';

      }
      construc += "</div>";
      $('.preview').append(construc);


    });
    $(".preview").on('click','span.imageremove',function(){
      //console.log($(this).next("img"));
      var trash = $(this).data("file");
      for(var i=0; i<storedFiles.length; i++){
       if(storedFiles[i].name === trash){
        storedFiles.splice(i,1);
        break;
       } 
      }
      $(this).parent().remove();

    }
    );



      $("#publishpost").click(function(){
        var url = '{{URL::to('/')}}' +"/post";
        form_data.append("content", $("#contentpost").val());
        form_data.append("privacy", $("#privacy").val());


        //alert(url);
        $.ajax({
          method: "POST",
          url:url,
          cache: false,
          contentType: false,
          processData: false,
          data:form_data
        }).done(function(data){
          if(data.success){
            form_data = new FormData();
            storedFiles=[];
            alert(data.message);
            location.reload();
            
        //RESET FORM AFTER POST
            $('postform').trigger("reset");
            $(".preview").html("");
          }
          //console.log(data);
        }).fail(function(data){
          alert(data.message);
        });
      });

//reaction start
$(".reaction").on("click",".reactionBtn", function(){
      var url = '{{URL::to('/')}}' +"/react";
      //alert(url);
       //$postid = $(this).data('postid');
      // $reactionid = $(this).data('reaction');
      // alert($postid + ":" + $reactionid);
//ajax start
$.ajax({
          method: "POST",
          url:url,
          /* cache: false,
          contentType: false,
          processData: false, */
          data:{
            'postid': $(this).data('postid'),
            'react': $(this).data('reaction'),
            r:Math.random()},
        success: (data) =>  {
          console.log($(this).data('postid'), "INSIDE AJHAX")
        }
        }
        ).done((data) => {
        //  console.log(data);
         // return;
          if(data.success){
            //alert(data.message);
            $(this).parent().find('.like').html(data.liked);
            $(this).parent().find('.smiled').html(data.smiled) ;
            $(this).parent().find('.heart').html(data.loved);
            $(this).parent().find('.dislike').html(data.disliked)
            if (data.liked <= 0) {
              $(this).parent().find('.like').parent().removeClass('text-primary')
              // $('#like').parent().removeClass('text-primary')
              $(this).parent().find('.like').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.like').parent().removeClass('text-secondary')
              $(this).parent().find('.like').parent().addClass('text-primary')
            }
            //
            if (data.smiled <= 0) {
              $(this).parent().find('.smiled').parent().removeClass('text-primary')
              $(this).parent().find('.smiled').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.smiled').parent().removeClass('text-secondary')
              $(this).parent().find('.smiled').parent().addClass('text-primary')
            }
            //
            if (data.loved <= 0) {
              $(this).parent().find('.heart').parent().removeClass('text-primary')
              $(this).parent().find('.heart').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.heart').parent().removeClass('text-secondary')
              $(this).parent().find('.heart').parent().addClass('text-primary')
            }
            //
            if (data.disliked <= 0) {
              $(this).parent().find('.dislike').parent().removeClass('text-primary')
              $(this).parent().find('.dislike').parent().addClass('text-secondary')
            }else {
              $(this).parent().find('.dislike').parent().removeClass('text-secondary')
              $(this).parent().find('.dislike').parent().addClass('text-primary')
            }


            // location.reload();
            
        //RESET FORM AFTER POST
            //$('postform').trigger("reset");
            //$(".preview").html("");
          }
          //console.log(data);
        }).fail(function(data){
          alert(data.message);
        });
 //ajax end

     });  
//reaction ends
//comment container show hide start
          $(".viewpost").on("click",".commentToggleBtn", function(){
            $(this).next(".commentContainer").toggle(250);

          });
//comment container show hide end
//post comment container show hide start
$(".viewpost").on("click",".postcommentToggleBtn", function(){
            $(this).next(".postcommentContainer").toggle(250);

          });
//post comment container show hide end

    });
          document.querySelector('#delete-button').addEventListener('submit', function(e) {
            var form = this;
            
            e.preventDefault();
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, post cannot be recovered",
                icon: "warning",
                buttons: [
                  'No, cancel it!',
                  'Yes, I am sure!'
                ],
                dangerMode: true,
              }).then(function(isConfirm) {
                if (isConfirm) {
                  form.submit();
      
                }
              });
          });
          $('.deleteComment').click(function (e){
              e.preventDefault();
              let form = $(this).parents('form');
              swal({
                  title: 'Are you sure?',
                  text: 'Once deleted, Comment cannot be recovered',
                  icon: 'warning',
                  buttons: ["Cancel it", "Yes, sure"],
                  dangerMode: true,
              }).then(function(value) {
                  if(value){
                      form.submit();
                  }
              });
          })
          
    </script>


  </body>
</html>
