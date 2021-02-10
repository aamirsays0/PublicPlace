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
                <img src="{{asset('storage/profile/'.$comment->user->id.'_profile.png')}}" alt="user" class="profile-photo-md"/>
                <div class="comment-body">
                    <h5 class="commenter-name">{{ $comment->user->name }}</h5>
                    <h5>{{ $comment->comments }}</h5>
                </div>
                @if ($comment->user->id === auth()->id())
                    <div class="actions deleteComment" data-id="{{ $comment->id }}">
                        <i class="fa fa-trash"></i>
                    </div>
                @endif
                <hr>
            </div>
        @endforeach

    </div>
</div>


<form id="comment-form" >        
    @csrf
    <input type="text" name="comment" id="comment" placeholder="{{ __("Say Something") }}" class="form-control">
</form>

    
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
        text: "Once added, Request will be sent",
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

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
