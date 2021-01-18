@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
     .singleImage{
       position:relative;
     }
     .singleImage span{
       position:absolute;
       top:-10px;
       right:-10px;
       border-radius:50%;
     }
@endpush


@section('sidebar-left')
   @include('partials.leftSidebar')
@endsection

@section('content')
     
         <!-- Post Create Box
            ================================================= -->
        <div class="create-post">
            <form action="" id="postform">
            	<div class="row">
            		<div class="col-md-7 col-sm-7">
                  <div class="form-group">
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="profile-photo-md" />
                    <textarea name="texts" id="contentpost" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                  </div>
                 <!-- <div class="form-group">
                  <label for="post-images" title="Upload Images">
                  <img src="{{asset('images/envato.png')}}"/>
                  </label>
                <input type="file" id="post-images" class="d-none" name="photos[]" accept="image/gif, image/jpeg, image/png" multiple/>
                  <div class="preview"></div>
                  </div>-->
                </div>
            		<div class="col-md-5 col-sm-5">
                  <div class="tools">
					 <ul class="publishing-tools list-inline list-unstyled">
                        <li class="list-inline-item"><a href="#"><i class="ion-compose"></i></a></li>
                        <li class="list-inline-item">
                        <label for="post-images" title="Upload Images">
                        <i class="ion-images fa-lg"></i>
                          </label>
                           <input type="file" id="post-images" class="d-none" name="photos[]" accept="image/gif, image/jpeg, image/png" multiple/>

                               </li>
                        <li class="list-inline-item"><label for="post-videos" title="Upload videos"><i class="ion-ios-videocam"></i></label><input type="file" id="post-videos" class="d-none" name="videos[]" accept="video/MOV, video/mp4" multiple/></li>
                        <li class="list-inline-item"><a href="#"><i class="ion-map"></i></a></li>
                        <li class="list-inline-item">
                        <select id="privacy">
                        <option value="public">public</option>
                        <option value="friends">friends</option>
                        <option value="me">Only me</option>

                        </select>
                        </li>

                      </ul>
                    <button type="button" id="publishpost" class="btn btn-primary pull-right">Publish</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <div class="preview"></div>

                  </div>

                </div>

              </div>
               </form>
            </div><!-- Post Create Box End-->

       @if ($message = Session::get('success'))
              <div class="alert alert-success" id="errorcontainer">
              <h3>{{$message}}</h3>
              </div>
              @endif
       <div class="scroll">
                   <!-- Media
            ================================================= -->

            <div class="media">
            	<div class="row js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": true }'>
                <div class="grid-sizer col-md-6 col-sm-6"></div>
                @foreach($images as $img)
                 <div class="grid-item col-md-6 col-sm-6">
            			<div class="media-grid">
                    <div class="img-wrapper">
                    <a href="{{url('/storage/postimages/'.$img->imgname)}}"data-lightbox="imageset-{{$img->post_id}}">
              
                    <img src="{{url('/storage/postimages/'.$img->imgname)}}" style="height: 200px;width: 311px;"/>
    </a>
                      </div>
                      
                  </div>
            		</div>
                @endforeach 
            	</div>
            </div>
          </div>
         
        </div>
@endsection

@section('sidebar-right')
          <div class="suggestions" id="sticky-sidebar">
          @include('partials.friendrequests')  
             </div>
@endsection

@section("script")
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
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
  var template = '<a href="{{url('post/')}}/'+data.pid+'" class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h6><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
              }
  else if(data.type == "reactions"){
    var template = '<a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h6><p class="small-text text-success">\n' +
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
             $("ul.pagination").hide();
             $('.scroll').jscroll({
               autoTrigger: true,
               nextSelector : '.pagination li.active + li a',
               contentSelector: 'div.scroll',
               callback: function(){
                 $('ul.pagination:visible:first').hide();
               }

             });
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
    $(document).on('change', '#post-videos',function(){
      $('.preview').html("");
      len_files = $("#post-videos").prop("files").length;
      var construc = "<div class='row'>";
      for (var i = 0; i < len_files; i++){
        var file_data = $("#post-videos").prop("files")[i];
        form_data.append("videos[]", file_data);
        construc += '<div class="col-3"><span class="btn btn-sm btn-danger vidremove">&times;</span><img width="120px" height="120px" src="' + window.URL.createObjectURL(file_data) + '"alt="' + file_data.name + '"/></div>';

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
    $(".preview").on('click','span.vidremove',function(){
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
//CONFIRM FRIEND REQUEST
           $(".confirmBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/confirmfriend/"+f;
             $.ajax({
          method: "POST",
          url:url,
          cache: false,
          contentType: false,
          processData: false,
          data:{r:Math.random()}
        }).done(function(data){
         // console.log(data);
         // return;
          if(data.success){
            alert(data.message);
            t.parent().parent().remove();

           // location.reload();
            
        //RESET FORM AFTER POST
            //$('postform').trigger("reset");
            //$(".preview").html("");
          }
          //console.log(data);
        }).fail(function(data){
          alert(data.message);
        });
           });

//DELETE FRIEND REQUEST

//reaction start
     $("#contentpostContainer").on("click",".reactionBtn", function(){
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
            r:Math.random()}
        }).done(function(data){
         console.log(data);
         // return;
          if(data.success){
            //alert(data.message);

            location.reload();
            
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
          $("#contentpostContainer").on("click",".commentToggleBtn", function(){
            $(this).next(".commentContainer").toggle(250);

          });
//comment container show hide end

    });
    </script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
