@extends("layouts.yellow")
@push('style')
     .mycss{ background-color: green;}
@endpush

@section('sidebar-left')
     @include('partials.leftSidebar')
@endsection

@section('content')
<!--   Friends List
  ================================ -->
  <h2>Your Activity</h2>
<div class="friend-list">
<div class="scroll">

     <?php
      $olddate = "";
      $newdate = "";
      $first = true;
      $content = "";
      foreach($allActivity as $singleActivity){
        $newdate = $singleActivity->created_at->format('Y-m-d');
        if($first){
            $olddate = $singleActivity->created_at->format('Y-m-d');
        }
        if($olddate === $newdate){
            if($first == true){
                $first = false;
                $content .="<div class='card my-3'><div class='card-header'>".$newdate."</div><div class='card-body'>";
            }
            $content .= \App\Custom\Activity::getview($singleActivity);
        }
        else{
            $content .="</div></div>";
            $content .="<div class='card my-3'><div class='card-header'>".$newdate."</div><div class='card-body'>";
            $content .= \App\Custom\Activity::getview($singleActivity);
        }
        $olddate = $newdate;
      }
      echo $content."</div></div>";
      ?>
      
      </div>
      {{$allActivity->links()}}
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
</script>
<script>
    var form_data = new FormData();
 

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
//delete friend request end
    });
    </script>

@endsection
@push('style')

     .anothercss{ background-color: green;}

@endpush
