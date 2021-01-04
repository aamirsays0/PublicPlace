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
    <link href="{{asset('css/my_css.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/lightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/headerNewStyles.css')}}"/>

    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('images/fav.png')}}">
  </head>
  <body>
  

@include('partials.headermenu')
    <div class="container">

      <!-- Timeline
      ================================================= -->
       <div class="timeline">
      <div class="timeline-cover" style="background-image: url('{{asset('storage/profile/'.$user->id.'_cover.jpg')}} ')"  data-lightbox="cp">
      <div id="showcpbtncontainer">
      <span><i class ="fa fa-expand text-dark"></i></span>
     </div>
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                <a href="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}" data-lightbox="pp">
                <img src="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}" alt="" class="img-fluid profile-photo"/>
                 </a>
                  <h4>{{isset($user->profiles->f_name , $user->profiles->l_name) ? $user->profiles->f_name.' '.$user->profiles->l_name : $user->name}}</h4>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="{{url('profiles/'.$user->id)}}" class="active">Timeline</a></li>
                  <li><a href="timeline-about.html">About</a></li>
                  <li><a href="timeline-album.html">Album</a></li>
                  <li><a href="{{url('friends/'.$user->id)}}">Friends</a></li>
                </ul>
                
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <!-- <div class="navbar-mobile hidden-lg hidden-md">
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
          </div> --><!--Timeline Menu for Small Screens End-->

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
        @include('partials.profilemenu')
            </div>
            <div class="col-md-7" style="padding-right: 30px;">
            @if ($message = Session::get('success'))
              <div class="alert alert-success" id="errorcontainer">
              <h3>{{$message}}</h3>
              </div>
              @endif
            
<!-- tabs start-->
<h3>{{isset($user->profiles->f_name , $user->profiles->l_name) ? $user->profiles->f_name.' '.$user->profiles->l_name : $user->name}} Timeline</h3>
  <br>
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
    <div class="scroll">

       @forelse($user->posts as $userpost)

            

            <!-- Post Content
            ================================================= -->
            <div class="post-content  postid-{{$userpost->id}}">
            
              <div class="post-container">
                <img src="{{asset('storage/profile/'.$userpost->user_id.'_profile.jpg')}}" alt="user" class=" img-responsive profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5>
                    <a href="{{$userpost->user->id}}" class="profile-link">{{$user->profiles?$user->profiles->f_name.' '.$user->profiles->l_name:$user->name}}</a> 
                    <span>
                    @if($userpost->privacy == 'public')
                    <i class ="ion-ios-world"></i>
                    @elseif($userpost->privacy == 'friends')
                    <i class ="fa fa-users"></i>
                    @endif
                    </span>
                    </h5>
                    <p class="text-muted"><a href="{{url('posts/'.$userpost->id)}}">Published about {{\Carbon\Carbon::parse($userpost->created_at)->diffForHumans()}}</a></p>
                  </div>
                  @php
                  $reactCount = [
                   'l'=>0,
                   'd'=>0,
                   'h'=>0,
                   's'=>0,
                   'reacted'=>false,
                   'type'=>"0"

                  ];
                  $totalReactions = $userpost->reactions->count();
                  foreach($userpost->reactions as $reaction){
                    if($reaction->user_id == Auth::id()){
                      $reactCount ['type'] = $reaction->type;
                      $reactCount ['reacted'] = true;

                    }
                    $reactCount [$reaction->type]++;
                  }
                  $my_reaction = ($reactCount['reacted'])?"You and ":"";
                  if($reactCount['reacted'] && $totalReactions == 1){
                    echo "<span>Only you reacted</span>";

                  }
                  else{
                    if($reactCount['reacted']){$totalReactions--;}
                  echo "<span>".$my_reaction.$totalReactions." people reacted</span>";
                  }
                  @endphp
                  <div class="reaction" id='contentpostContainer'>
                  <a data-postid="{{$userpost->id}}" data-reaction="l" class="btn text-{{($reactCount ['type']==="l")?"primary":"secondary"}} reactionBtn"><i class="icon ion-thumbsup"></i>
                      <span class="like" >{{$reactCount['l']}}<span>
                    </a>
                    <a  data-postid="{{$userpost->id}}" data-reaction="d" class="btn text-{{($reactCount ['type']==="d")?"danger":"secondary"}} reactionBtn"><i class="fa fa-thumbs-down"></i>
                      <span class="dislike" >{{$reactCount['d']}}<span>
                    </a>
                    <a data-postid="{{$userpost->id}}" data-reaction="h" class="btn text-{{($reactCount ['type']==="h")?"success":"secondary"}} reactionBtn"><ion-icon name="heart"></ion-icon>
                      <span class="heart" >{{$reactCount['h']}}</span>
                    </a>
                    <a  data-postid="{{$userpost->id}}" data-reaction="s" class="btn text-{{($reactCount ['type']==="s")?"success":"secondary"}} reactionBtn"><ion-icon name="happy"></ion-icon> 
                      <span class="smiled">{{$reactCount['s']}}</span>
                    </a>
                    <a href="{{ route('posts.show', $userpost->id) }}" class="btn btn-info fa fa-eye"></a>

                    @if($userpost->user_id == Auth::id())
                    {!! Form::open(['url' => 'posts/'.$userpost->id,'method' => 'delete','class' => 'btn d-inline']) !!}
                    <button class="btn btn-danger fa fa-trash" onclick="return confirm('are sure you want to delete this post?')"></button>
                    {!! Form::close() !!}                   
                    <!-- DELETE ICON -->
                    <!--<a href={{url('post'.'/'.$userpost->id) }}" onclick="event.preventDefault(); document.getElementById('delete-post').submit();" class="fa fa-trash"></a><form id="delete-post" action="{{ url('post'.'/'.$userpost->id)}}" method="DELETE" style="display: none;"@csrf</form>-->
                    @endif

                    
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{$userpost->content}}</p>
                    <hr>
                    @forelse($userpost->pictures as $pic)
                    <?php
                    $imageinfo = pathinfo(url('/storage/postimages/'.$pic->imgname));
                    //print_r($imageinfo);
                    ?>
                    <a href="{{url('/storage/postimages/'.$pic->imgname)}}" data-lightbox="imageset-{{$userpost->id}}">
                    <img src=" {{url('/storage/postimages/'.$imageinfo['filename'].".".$imageinfo['extension'])}}" alt="" width="120px">
                    </a>
                    @empty

                    @endforelse
                   
                  </div>
                  <div class="line-divider"></div>
                  <div class="viewpost"><a href="javascript:void(0)" class="commentToggleBtn">{{$userpost->comments->count()}} <span><i class="fa fa-comment" style="font-size: 18px;"></i></span></a>
                  <div class="commentContainer" style="display: none;">
                   @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                   @forelse($userpost->comments as $usercomment)
                    <div class="post-comment">
                    <img src="{{asset('storage/profile/'.$usercomment->user_id.'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                    <p><a href="{{url('profiles/'.$usercomment->user->id)}}" class="profile-link">{{$usercomment->user->name}}</a>
                    <i class="em em-laughing"></i>{{$usercomment->comment}}</p>
                    @if (Auth::check())
                      @if(count((array) $userpost->comments) > 0)
                       @if($usercomment->user->id == Auth::user()->id)
                        {!! Form::open(['url' => 'deleteComment/'.$usercomment->id,'method' => 'delete','class' => 'btn d-inline', 'route'=>'delete.comment']) !!}
                         <button class="btn btn-danger fa fa-trash" onclick="return confirm('are sure you want to delete this comment?')"></button>
                        {!! Form::close() !!}
                       @endif
                      @endif
                     @endif
                  </div>
                  @empty
                  <h3>No comments added yet</h3>
                  @endforelse
                  </div>
                  <a href="javascript:void(0)" class="postcommentToggleBtn"><span><i class="ion-compose ion-icons-colors" style="font-size: 18px; position:absolute; right:65%; "></i></span></a>
                  <div class="postcommentContainer" style="display: none;">
                  <div class="post-comment">
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile_thumb.jpg')}}" alt="" class="profile-photo-sm" />
                    {!! Form::open([
                    'route'=> ['posts.comment',$userpost->id],
                      'class'=>'form']) !!}
                    <div class="form-group">
                    <input type="text" name="postcomment" class="form-control" placeholder="Post a comment">
                    <button class="btn btn-light form-control" style="  border: 1px solid grey;" type="submit" name="commentBtn">Comment</button>
                    </div>
                    {!! Form::close() !!}
                   </div>
                   </div>
                </div>
                    </div>
              </div>
            </div>
       @empty
       <h3>No posts avaliable</h3>
        @endforelse

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
    </script>


  </body>
</html>
