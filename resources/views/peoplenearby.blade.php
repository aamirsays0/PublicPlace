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
                @if ($message = Session::get('success'))
              <div class="alert alert-success" id="errorcontainer">
              <h3>{{$message}}</h3>
              </div>
              @endif
<!-- tabs start-->
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="tab-content tab-pane active"><br>
      <div class="people-nearby">
      @forelse($users as $user)
       <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                  @if (file_exists(public_path('storage/profile/'.$user->id.'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}"  alt="user" class="profile-photo-lg" />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-lg" id="uploadImage" alt="">
                   @endif
                  </div>

                  <div class="col-md-7 col-sm-7">

                    <h5><a href="{{url('profiles/'.$user->id)}}" class="profile-link">{{$user->profiles?$user->profiles->f_name.' '.$user->profiles->l_name:$user->name}}</a></h5>
                    <p style="font-size: 1.7rem;">{{$user->email}}</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    @if(in_array($user->id,$req))
                    @if (Auth::user()->id !== $user->id)
                        <span class="pull pull-right">Friends</span>
                      @endif
                    @else
                      {{-- @if(array_search($user->id, array_column($his_friends, array_search(auth()->id(), array_column($his_friends, 'user_id')) ? 'friend_id':'user_id' ))) --}}
                          @if((array_search($user->id, array_column($his_friends, 'user_id')) !== false) || 
                            (array_search($user->id, array_column($his_friends, 'friend_id')) !== false))                     
                        <button class="btn pull pending pull-right" disabled>Pending</button>
                      @else 
                      <button class="btn pull pull-right addFrndBtn" data-uid="{{$user->id}}">Add Friend</button>
                      @endif
                    @endif
             
                  </div>

                </div>
         </div>
          @empty
          @endforelse
      
      
    </div>
    
  </div>
  </div>
<!-- tabs end -->
@endsection

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
  @section('sidebar-right')
          <div class="suggestions" id="sticky-sidebar">
          @include('partials.friendrequests')
             </div>
@endsection

@section("script")
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>
     $(document).ready(function(e){
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });
 
 $("#home").on("click",".addFrndBtn",function(){
   var url = '{{URL::to('/')}}' +"/addfriend/" +$(this).data('uid');
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
                         
             $.ajax({
                   method: "POST",
                   url:url,
                   cache: false,
                   data:{r:Math.random()}
                 }).done(function(data){
                   console.log(data);
                   if(data.success){
                     swal("Request sent", data.message, 'success');
                     location.reload();
                 //RESET FORM AFTER POST
                    // $('postform').trigger("reset");
                     //$(".preview").html("");
                   }
                   //console.log(data);
                 }).fail(function(data){
                   console.log(data);
                   alert(data.message);
                 });
         
          } else {
            swal("Cancelled", "User in not added as friend", "error");
          }
        });




 });
 //CONFIRM FRIEND REQUEST
 //CONFIRM FRIEND REQUEST
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
    @endsection
  </body>
</html>
