@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
@endpush

@section('sidebar-left')
     @include('partials.leftSidebar')
@endsection

@section('content')

<div class="row">
    <div class="col-sm-1 text-left"><h4><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a></h4></div>
    <div class="col-sm-11"><h4>{{ $story_data->user->name }}'s Stories</h4></div>
</div>

<div class="row video-player-wrapper">
    <div class="col-12">
        <video controls class="video-player">
            <source src="{{ asset('videos/stories/'.$story_data->story) }}" type="video/mp4">
                Your browser does not support the video tag.
        </video>
    </div>
</div>

<div class="post-content">    
    <div class="post-container comments-wrapper">
        
        @foreach ($story_data->comments as $comment)
            <div class="comment-wrapper" id="{{ $comment->id }}">
                  @if (file_exists(public_path('storage/profile/'.$comment->user->id.'_profile.jpg')) )
                  <img src="{{asset('storage/profile/'.$comment->user->id.'_profile.jpg')}}" alt="user" class="profile-photo-md"/>
                         @else
                          <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                       @endif
                <div class="comment-body">
                    <h5 class="commenter-name">
                    <div class="profile-link1">
                    <a href="{{url('profiles/'.$comment->user->id)}}" class="profile-link commenter-name">{{$comment->user->profiles?$comment->user->profiles->f_name.' '.$comment->user->profiles->l_name: $comment->user->name }}</a>
                    <div class="friend-card1">
                        @if (file_exists(public_path('storage/profile/'.$comment->user_id.'_cover.jpg')) )
                         <img src="{{asset('storage/profile/'.$comment->user_id.'_cover.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                         @else
                         <img src="{{ asset('images/no-cover.png') }}" class="img-responsive cover" id="uploadImage"  alt="profile-cover" class="img-responsive cover" />
                         @endif
                        <div class="card-info">
                             @if (file_exists(public_path('storage/profile/'.$comment->user_id.'_profile.jpg')) )
                             <img src="{{asset('storage/profile/'.$comment->user_id.'_profile.jpg')}}" alt="user" class="profile-photo-md"/>
                             @else
                            <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="user">
                             @endif
                           <div class="friend-info">
                                  <h5><a href="{{url('profiles/'.$comment->user_id)}}" class="profile-link">
                                   {{$comment->user->profiles?$comment->user->profiles->f_name.' '.$comment->user->profiles->l_name:$comment->user->name}}</a>
                                                     
                                      @if(in_array($comment->user->id,$req) )
                                        @if (Auth::user()->id !== $comment->user->id)
                                          <span class="pull pull-right">Friends</span>
                                        @endif
                                      @else
                                        @if( isset($his_friends) && array_search($comment->user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' )))
                                        <button class="btn pull pending pull-right" disabled>Pending</button>
                                        @else 
                                        <button class="btn pull addFrndBtn pull-right" data-uid="{{$comment->user->id}}">Add Friend</button>
                                        @endif
                                      @endif
                                    </h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-envelope"></i>  {{$comment->user->email}}</h5>
                                  <h5 style="color: #7f8c8d"><i class="fa fa-map-marker" aria-hidden="true"></i>  {{$comment->user->profiles?$comment->user->profiles->city:"No city details"}}, {{$comment->user->profiles?$comment->user->profiles->country:"No country details"}}</h5>
                                  <h5 style="color: #7f8c8d">{{ $comment->user->profiles?$comment->user->profiles->description:"No Description" }}</h5>
                                <table class="tablecard">
                                    <tr>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>{{$comment->user->posts->count()}}</b></h5>
                                          <h5 style="color: #7f8c8d">Posts</h5>
                                        </td>
                                        <td>
                                          <h5 style="color: #7f8c8d">
                                          <h5 style="color: #7f8c8d"><b>{{$comment->user->friend->count() + $comment->user->friends2->count()}}</b></h5>
                                          </h5>
                                          <h5 style="color: #7f8c8d">Friends</h5>
                                        </td>
                                        <td>
                                          <h5 style="color: #7f8c8d"><b>892</b></h5>
                                          <h5 style="color: #7f8c8d">Following</h5>
                                        </td>
                                    </tr>
                                </table>
                        </div>
                      </div>
                    </div>

                  </div> 

                    </h5>
                    <h5>{{ $comment->comments }}</h5>
                </div>
                @if ($comment->user->id === auth()->id())
                    <div class="actions deleteComment" data-id="{{ $comment->id }}">
                        <i class="fa fa-trash"></i>
                    </div>
                @endif

                <div class="row">

                </div>
            </div>
        @endforeach

    </div>
</div>


<form id="comment-form" >        
    @csrf
    <input type="text" name="comment" id="comment" placeholder="{{ __("Say Something") }}" class="form-control">
</form>

    
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
  var template = '<a href="{{url('posts/')}}/'+data.pid+'" class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
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

$(document).ready(function() {
     // CSRF Token
     $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
})

//  Submit comment on enter
document.getElementById('comment').addEventListener('keypress', function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('comment.store', $story_data->id) }}",
            method:"POST",
            data: {
                comment: $(this).val(),
                story_id: '{{ $story_data->id }}'
            },
            success: function(res) {
                console.log(res)

                $('#comment').val("")

                const comment = `<div class="comment-wrapper" id="${ res.data.comment_id }">
                    <img src="${ res.data.profile_pic }" alt="user" class="profile-photo-md"/>
                    <div class="comment-body">
                        <h5 class="commenter-name">${ res.data.user_name }</h5>
                        <h5>${ res.data.comment }</h5>
                    </div>
                    <div class="actions deleteComment" data-id="${ res.data.comment_id }">
                        <i class="fa fa-trash"></i>
                    </div>
                    <hr/>
                </div>`;

                $('.comments-wrapper').append(comment)

            },
            error: function(err) {
                console.log(err)
            }            
        })
    }
});

// Delete comment on click
$(document).on('click', '.deleteComment', function() {
    let comment_id = $(this).data('id')

    swal({
        title: "Are you sure?",
        text: "Once deleted, comment will not recover",
        icon: "warning",
        buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
        ],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            const deleteCommentUrl = `/comments/${comment_id}`

            $.ajax({
                url: deleteCommentUrl,
                method: "DELETE",
                success: function(res) {
                    console.log(res)
                    swal("Comment Deleted Successsfully", "", 'success');
                    $(`#${comment_id}`).remove();
                },
                error: function(err) {
                    console.log(err)
                    swal("Something went wrong, please try again", err.error, 'error');
                }
            })
        }
    });
});

</script>
<script>
 $(document).ready(function(e){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });
//CONFIRM FRIEND REQUEST
//CONFIRM FRIEND 
$(".confirmBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/confirmfriend/"+f;
             swal({
          title: "Are you sure?",
          text: "Once confirmed, This user will be your friend",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
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
                    swal("Successful", data.message, "success");
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
    

          } else {
             swal("Cancelled", "You have no new friend :)", "error");
          }
        });




           });
//confirm friend end
//DELETE FRIEND REQUEST
$(".deleteBtn").click(function(e){
             var t = $(this);
             e.preventDefault();
             var f= $(this).data('uid');
             var url = '{{URL::to('/')}}' +"/deletefriend/"+f;
             swal({
          title: "Are you sure?",
          text: "Once deleted, Friend request will be rejected",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
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
                    swal("Deleted", data.message, "success");
                    t.parent().parent().remove();

                  // location.reload();
                  }
                  //console.log(data);
                }).fail(function(data){
                  alert(data.message);
                });
    

          } else {
             swal("Cancelled", "You have no new friend :)", "error");
          }
        });




           });
//Delete requests end
 });
</script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
