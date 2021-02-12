@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
@endpush

@section('sidebar-left')
     @include('partials.leftSidebar')
@endsection

@section('content')

<h2>Stories</h2>

<div class="post-content">    
    <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">        
        @csrf
        <div class="post-container">
            <div class="text-center">          
                <h4>You can upload videos as stories here</h4>
                <label for="story" class="upload-proxy"><i class="icon ion-ios-videocam"></i> Click to Upload Your Story</label>
                <label id="selection-indicator" class="text-danger" style="display: none">Selected</label>
                <input type="file" name="story[]" id="story" class="d-none" multiple>
                <input class="btn btn-sm btn-info" type="submit" value="Save">
            </div>           
        </div>
    </form>
</div>

{{-- His Stories --}}
<div class="row">
    @foreach ($stories as $story)
    <div class="col-sm-12 col-md-6">
        <a href="{{ route('stories.show', $story->id) }}">
            <video controls>
                <source src="{{ asset('videos/stories/'.$story->story) }}" type="video/mp4">
                    Your browser does not support the video tag.
            </video>
        </a>
    </div>
    @endforeach
</div>

{{-- His Stories ends here --}}
    
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

 $('.upload-proxy').on('click', function() {
     $('.story').trigger('click')
 })

 $('.story').on('change', function() {
    $('#selection-indicator').show()
 })
</script>
<script>
 $(document).ready(function(e){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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
 });
</script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
