<div id="sticky-sidebar">
        <div class="profile-card static" style="background-image: linear-gradient(to bottom, rgb(4 76 89 / 16%), rgb(4 76 89 / 85%)), url('{{asset('storage/profile/'.Auth::id().'_cover.jpg')}} ');">
                    @if (file_exists(public_path('storage/profile/'.Auth::id().'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.Auth::id().'_profile.jpg')}}" alt="" class="profile-photo " />
                    @else
                       <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo" id="uploadImage" alt="">
                    @endif
             	  <h5><a class="text-white">{{ isset(Auth::user()->profiles->f_name) ? Auth::user()->profiles->f_name.' '.Auth::user()->profiles->l_name: Auth::user()->name}}</a></h5>
            	   <a href="{{url('friends/'.Auth::id())}}" class="text-white" title="{{$friends->count()-1}} Friends"><i class="ion ion-android-person-add"></i>{{$friends->count()-1}} Friends</a>
          </div>
<!--profile card ends-->
        <ul class="nav-news-feed">

              <li><i class="icon ion-ios-paper"></i><div><a href="{{url('profiles/'.Auth::id())}}">My Timeline</a></div></li>
              <li><i class="icon ion-ios-people"></i><div><a href="{{ route('people.nearby')}}">People Nearby</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="{{url('friends/'.Auth::id())}}">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="{{url('chat')}}">Messages</a></div></li>
              <li><i class="icon ion-images"></i><div><a href="{{route('my.images')}}">Images</a></div></li>
              <li><i class="icon ion-ios-videocam"></i><div><a href="{{route('my.videos')}}">Videos</a></div></li>
            </ul><!--news-feed links ends-->
        <div id="friends-block">
        <a href="{{url('friends/'.Auth::id())}}"><button type="button" class="ftitle">Friends</button></a>
              <hr>
              <ul class="online-users list-inline list-unstyled">
              @forelse($friends as $friend)
                @if($friend->id != Auth::id())
                <li class="list-inline-item"><a href="{{url('profiles/'.$friend->id)}}" title="{{$friend->name}}">
                @if (file_exists(public_path('storage/profile/'.$friend->id.'_profile.jpg')) )
                    <img src="{{asset('storage/profile/'.$friend->id.'_profile.jpg')}}" alt="" class="profile-photo-md " />
                    @else
                    <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-md" id="uploadImage" alt="">
                   @endif
                   </a></li>
                 @endif
                 @empty
              <h3>no friends yet, search for new friends</h3>
              @endforelse 
              </ul>
              
            </div><!--Friends block ends-->
            <!-- <div id="chat-block">
            <button class="ctitle">Chat online</button>
              <ul class="online-users list-inline list-unstyled">
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Linda Lohan"><img src="images/users/user-2.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Sophia Lee"><img src="images/users/user-3.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="John Doe"><img src="images/users/user-4.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Alexis Clark"><img src="images/users/user-5.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="James Carter"><img src="images/users/user-6.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Robert Cook"><img src="images/users/user-7.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Richard Bell"><img src="images/users/user-8.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Anna Young"><img src="images/users/user-9.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li class="list-inline-item"><a href="newsfeed-messages.html" title="Julia Cox"><img src="images/users/user-10.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
              </ul>
            </div>  -->
            <!--chat block ends-->
            </div>