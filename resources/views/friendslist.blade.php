@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
@endpush


@section('sidebar-left')
  @include('partials.leftSidebar')
@endsection
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@section('content')
     
              <!-- Friend List
              ================================================= -->
              <div class="friend-list">
                <div class="row">
                @foreach($friends as $friend)
                @php
                    $friends_data = $friend->user_id == auth()->id() ? $friend->friendInfo : $friend->user;
                @endphp
                  <div class="col-md-4 col-sm-6" id="{{ $friend->id }}">
                    <div class="friend-card" style="border: none">
                    <a href="#" class="unfriend_it friend--trash_icon" data-friend_id="{{ $friend->id }}"><i class="fa fa-trash fa-lg"></i></a>
                        @if (file_exists(public_path('storage/profile/'.$friends_data->id.'_cover.jpg')) )
                        <a href="{{url('profiles/'.$friends_data->id)}}">
                         <img src="{{asset('storage/profile/'.$friends_data->id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover friends-list-img" />
                        </a>
                         @else
                        <a href="{{url('profiles/'.$friends_data->id)}}">
                         <img src="{{ asset('images/no-cover.png') }}" class="img-responsive cover friends-list-img" id="uploadImage" alt="">
                        </a> 
                         @endif
                         <div class="card-info">
                        @if (file_exists(public_path('storage/profile/'.$friends_data->id.'_profile.jpg')) )
                        <a href="{{url('profiles/'.$friends_data->id)}}">
                           <img src="{{asset('storage/profile/'.$friends_data->id.'_profile.jpg')}}" alt="user" class="profile-photo-lg"/>
                        </a>
                        @else
                        <a href="{{url('profiles/'.$friends_data->id)}}">
                          <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-lg" id="uploadImage" alt="">
                        </a>
                        @endif
                      <div class="friend-info">
                          <h5><a href="{{url('profiles/'.$friends_data->id)}}" class="profile-link">
                          {{$friends_data->profiles?$friends_data->profiles->f_name.' '.$friends_data->profiles->l_name : $friends_data->name}}</a></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  
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
  var template = '<a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
            '</div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">'+ data.message +'</h6><p class="small-text text-success">\n' +
               'Just Now</p></div></a><div class="dropdown-divider"></div>';
              }
  else if (data.type == "reactions"){
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
    $(".preview").on('click','span.imageremove',function(){
      console.log($(this).next("img"));
    }
    )
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
            alert(data.message);
            location.reload();
            
        //RESET FORM AFTER POST
            //$('postform').trigger("reset");
            //$(".preview").html("");
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
//DELETE FRIEND REQUEST
$(".deleteBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/deletefriend/"+f;
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

    $('.unfriend_it').on('click', function(e) {
        let friend_id = $(this).data('friend_id');
        
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
        $.ajax({
          method: "DELETE",
          url   : `/friend/unfriend_it/${friend_id}`,
          success: (response) => {
            console.log(response)
            $(`#${friend_id}`).remove();
          },
          error:   (response) => {
            console.error(response)
          }
        })
     })
    });
    </script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush