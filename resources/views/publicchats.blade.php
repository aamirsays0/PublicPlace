@extends('layouts.chatbox')

@section('sidebar-left')
    @include('partials.leftSidebar')
@endsection

@section('content')
<h3 class=" text-center">Messaging</h3>
            <!-- Chat Room
            ================================================= -->
            <div class="chat-room">
              <div  class="row">
                <div class="col-md-5" style="background-color: white;border: solid 1px #0000003d; height:500px !important;" id="allusers">

                  <!-- Contact List in Left-->
                  <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">
                  @forelse($users as $user)
                    @if($user->id == Auth::id())
                         @continue
                    @endif
      
                    <li class="chat_lists active_chat" data-userid ="{{$user->id}}">
                      <a href="#contact-1" data-toggle="tab">
                        <div class="contact">
                        @if (file_exists(public_path('storage/profile/'.$user->id.'_profile.jpg')) )
                        <img src="{{asset('storage/profile/'.$user->id.'_profile.jpg')}}" alt="" class="profile-photo-sm pull-left"style="position: absolute; top: 15%;">
                           @else
                              <img src="{{ asset('images/noimage.jpg') }}" alt="" class="profile-photo-sm pull-left"style="position: absolute; top: 15%;">
                           @endif
                        	<div class="msg-preview">
                          <h5>{{isset($user->profiles->f_name, $user->profiles->l_name)? $user->profiles->f_name.' '. $user->profiles->l_name: $user->name}}
                            <small class="text-muted"><i class="ion ion-chevron-right"></i></small></h5>
                        	</div>
                        </div>
                      </a>
                    </li>
                    @empty
                   @endforelse
                  </ul><!--Contact List in Left End-->

                </div>
                <div class="col-md-5" style="background-color: white;border: solid 1px #0000003d; height:500px !important; display: none" id="particularUser">
                  <button class="btn btn-block btn-info back-to-list" style="margin: 2rem 0">Back to list</button>
                  <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer"></ul>
                </div>

                <div class="col-md-7" style="background-color: white;border: solid 1px #0000003d;height:500px !important;">

                  <!--Chat Messages in Right-->
                  <div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
                    <div class="tab-pane active" id="contact-1">
                      <div class="chat-body">
                      	<ul class="chat-message" id="msg_history_container">
                        <!-- <li class="left">
                          <img src="images/users/user-2.jpg" alt="" class="profile-photo-sm pull-left" />
                          <div class="chat-item">
                            <div class="chat-item-header">
                              <h5>Linda Lohan</h5>
                              <small class="text-muted">3 days ago</small>
                            </div>
                            <p>Hi honey, how are you doing???? Long time no see. Where have you been?</p>
                          </div>
                        </li>
                        <li class="right">
                          <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-right" />
                          <div class="chat-item">
                            <div class="chat-item-header">
                              <h5>Sarah Cruiz</h5>
                              <small class="text-muted">3 days ago</small>
                            </div>
                            <p>I have been on vacation</p>
                          </div>
                        </li>-->
                      	</ul>
                      </div>
                    </div>
                    </div>
                  </div><!--Chat Messages in Right End-->
                <div class="clearfix"></div>
            </div>
            {{-- Make is visible when allowed to chat --}}
            {{-- <div class="row type-message" style="display: none">
              <div class="col-12">
                <div class="send-message">
                  <div class="input-group">
                    <input type="text" id="write_msgs" class="form-control" placeholder="Type your message">
                    <span class="input-group-btn">
                      <button id="write_msgss" class="btn btn-default" type="button">Send</button>
                    </span>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>

@endsection

@section('sidebar-right')
          <div class="suggestions" id="sticky-sidebar">
          @include('partials.friendrequests')
           
             </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
      var baseurl = '{{URL::to('/')}}' +"/";
      // listen pusher start
        Pusher.logToConsole = true;
        var pusher = new Pusher ('0e8a23a77d5e825ac0fc', {
          cluster: 'ap2',
          useTLS: true
          
        });
        var channel = pusher.subscribe('user-user_id');
        
        channel.bind('new-post', function(data){
          $m = data.message;
            if(data.type == "message"){
        /*      console.log(data.mtime); */
        if(data.type == "message" || data.user_id == user_id){
              if(data.user_id == user_id){
              var template = '<li class="right pull-right" style="padding-left: 150px;padding-top: 15px;""><img src="'+baseurl+'storage/profile/'+data.user_id+'_icon.jpg'+'" alt="'+data.user_name+'" class="profile-photo-sm pull-right"><div class="chat-item"><p style="font-size: 13px;">'+data.chatmessage+'</p><small class="text-muted">' + data.mtime + '</small></div></li>';
            }
            else {
              $("#notificationDropdown span.count").text(
                parseInt($("#notificationDropdown span.count").text())
                +1).addClass('text-danger');

              var template = '<li class="left" style="padding-right: 150px;padding-top: 15px;""><img src="'+baseurl+'storage/profile/'+data.user_id+'_icon.jpg'+'" alt="'+data.user_name+'" class="profile-photo-sm pull-left"><div class="chat-item"><p style="font-size: 13px;">'+data.chatmessage+'</p><small class="text-muted">' + data.mtime + '</small></div></li>';
            }
            $("#msg_history_container").append(template);

          
            }
          else{
            $(".chat_lists[data-userid='"+data.user_id+"']").find('p').html(data.chatmessage).addClass('text-danger');
            if(data.type == "message" && data.user_id !== {{Auth::id()}}){
              var template ='<a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
                    '</div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">New Message from'+ data.user_name +'</h6><p class="small-text text-success">'+data.mtime+'</p></div></a><div class="dropdown-divider"></div>';
              $("#notificationDropdown span.count").text(
                parseInt($("#notificationDropdown span.count").text())
                +1).addClass('text-danger');
              $("#noteItemContainer").prepend(template);
            }
          }
            }
        
        });

// listen pusher ends

        //ajax setup

        $.ajaxSetup({
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
      });

        //ajax setup
  //select user
        $(".chat_lists").on("click",function(){
          $('#particularUser ul').html("")
          pusherchat()
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
              });
            $s = $(this);
            if($('.chat_lists').hasClass('active_chat')){
                $('.chat_lists').removeClass('active_chat');
            }
            $s.addClass('active_chat');
            $s.find('p').html('');
            $withUser= $s.data("userid");
            //($withUser);
            $("#write_msgs").attr('fid',$withUser);
             var url = '{{URL::to('/')}}' +`/user-chats/${$withUser}`;
            $.ajax({
                method: "get",
                url:url,
                }).done(function(data){
                  console.log('data', data)
                    if(data.length){
                        let mapData = data.map(el => {
                            return `<li class="user_chat" onclick="getChat(${el.friends_data.id}, ${$withUser})">
                            <a href="#" data-toggle="tab">
                            <div class="contact">
                            @if (file_exists('http://${window.location.host}/storage/profile/${el.friends_data.id}_profile.jpg')) )
                              <img src="http://${window.location.host}/storage/profile/${el.friends_data.id}_profile.jpg" alt="" class="profile-photo-sm pull-left"style="position: absolute; top: 15%;">
                            @else
                              <img src="{{ asset('images/noimage.jpg') }}" alt="" class="profile-photo-sm pull-left"style="position: absolute; top: 15%;">
                            @endif
                                <div class="msg-preview">
                                <h5>${el.friends_data.name}</h5>
                                </div>
                            </div>
                            </a>
                        </li>`;
                        })

                        $('#particularUser ul').append(mapData);
                        $('#allusers').hide();
                        $('#particularUser').show();
                    }
                    else{
                        $("#msg_history_container").html("");
                    }
            }).fail(function(data){
                console.log(data)       
            }); 
            
      });

      // Back to chat list;
      $('.back-to-list').click(function() {
        $(this).parent().hide()
        $('#allusers').show()
      })

  //select user
         //send chat
        $("#write_msgs").keypress(function(e){
            if(e.which == '13' && $(this).val() != ""){
              if($(this).attr('fid') == '0'){
                alert("select a friend first");
                return;
              }
                //alert("send " + $(this).val());
                //ajax start
         var url = '{{URL::to('/')}}' +"/sendchat";
          $.ajax({
          method: "POST",
          url:url,
          data:{
            fid:$(this).attr('fid'),
            m:$(this).val()
          }
        }).done(function(data){
          $("#write_msgs").val("");
          //console.log(data);
          /* if(data.status){
           // alert(data.message);
            //location.reload();
            
        //RESET FORM AFTER POST
            //$('postform').trigger("reset");
            //$(".preview").html("");
          } */
          //console.log(data);
        }).fail(function(data){
          alert(data.message);
        });
      
                //ajax end
            }
        });

        //send chat end

        function showMessages(data){
          var month = new Array();
              month[0] = "Jan";
              month[1] = "Feb";
              month[2] = "Mar";
              month[3] = "Apr";
              month[4] = "May";
              month[5] = "Jun";
              month[6] = "Jul";
              month[7] = "Aug";
              month[8] = "Sep";
              month[9] = "Oct";
              month[10] = "Nov";
              month[11] = "Dec";
          $t = "";

          if(!data.length){
            $t = "<h3>No messages to show</h3>";
          }
          else {
            for(var d in data){ 
              let date = new Date(data[d].created_at);
          date = `${date.getDate()} ${month[date.getMonth()]} ${date.getFullYear()} ${ date.getHours() }:${ date.getMinutes() }`
                  if(data[d].user_id == '{{Auth::id()}}'){
                    
                $t += '<li class="left" style="padding-right: 150px;padding-top: 15px;""><img src="'+baseurl+'storage/profile/'+data[d].user_id+'_icon.jpg'+'" alt="'+data[d].user_name+'" class="profile-photo-sm pull-left"><div class="chat-item"><p style="font-size: 13px;">'+data[d].message+'</p><small class="text-muted">' + date + '</small></div></li>';
              }
              else {
                $t += '<li class="left" style="padding-right: 150px;padding-top: 15px;""><img src="'+baseurl+'storage/profile/'+data[d].user_id+'_icon.jpg'+'" alt="'+data[d].user_name+'" class="profile-photo-sm pull-left"><div class="chat-item"><p style="font-size: 13px;">'+data[d].message+'</p><small class="text-muted">' + date + '</small></div></li>';
              }
           }
     $("#msg_history_container").html($t);
   }
        }


    // Show textbox on chat-click;
    $('.chat_lists').on('click', function() {
      $('.type-message').show();
    }) 

    getChat = function(user_id, host_id) {
      $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
              });
            $s = $(this);
            if($('.chat_lists').hasClass('active_chat')){
                $('.chat_lists').removeClass('active_chat');
            }
            $s.addClass('active_chat');
            $s.find('p').html('');
            $withUser= user_id;
            //($withUser);
            $("#write_msgs").attr('fid',$withUser);
             var url = '{{URL::to('/')}}' +`/user_specific/${host_id}/${user_id}`;
                $.ajax({
          method: "GET",
          url:url
        }).done(function(data){
          console.log('chatlog', data)
          if(data.length){
            showMessages(data);
          }
          else{
            $("#msg_history_container").html("");
          }
        }).fail(function(data){
          console.log(data)        
          }); 
      }
      
      pusherchat = function(user_id)
      {
        var channel = pusher.subscribe('user-{{Auth::id()}}');
        
        channel.bind('new-post', function(data){
          $m = data.message;
            if(data.type == "message"){
        /*      console.log(data.mtime); */
        if(data.type == "message" || data.user_id == {{Auth::id()}}){
              if(data.user_id == {{Auth::id()}}){
              var template = '<li class="right pull-right" style="padding-left: 150px;padding-top: 15px;""><img src="'+baseurl+'storage/profile/'+data.user_id+'_icon.jpg'+'" alt="'+data.user_name+'" class="profile-photo-sm pull-right"><div class="chat-item"><p style="font-size: 13px;">'+data.chatmessage+'</p><small class="text-muted">' + data.mtime + '</small></div></li>';
            }
            else {
              $("#notificationDropdown span.count").text(
                parseInt($("#notificationDropdown span.count").text())
                +1).addClass('text-danger');

              var template = '<li class="left" style="padding-right: 150px;padding-top: 15px;""><img src="'+baseurl+'storage/profile/'+data.user_id+'_icon.jpg'+'" alt="'+data.user_name+'" class="profile-photo-sm pull-left"><div class="chat-item"><p style="font-size: 13px;">'+data.chatmessage+'</p><small class="text-muted">' + data.mtime + '</small></div></li>';
            }
            $("#msg_history_container").append(template);

          
            }
          else{
            $(".chat_lists[data-userid='"+data.user_id+"']").find('p').html(data.chatmessage).addClass('text-danger');
            if(data.type == "message" && data.user_id !== {{Auth::id()}}){
              var template ='<a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-success"><i class="mdi mdi-alert-circle-outline mx-0"></i>\n' +
                    '</div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">New Message from'+ data.user_name +'</h6><p class="small-text text-success">'+data.mtime+'</p></div></a><div class="dropdown-divider"></div>';
              $("#notificationDropdown span.count").text(
                parseInt($("#notificationDropdown span.count").text())
                +1).addClass('text-danger');
              $("#noteItemContainer").prepend(template);
            }
          }
            }
        
        });

      }
    });

    </script>
@endsection