        <!--Edit Profile Menu-->
        <ul class="edit-menu " style="margin-top: 80px">
                <li class='{{Route::current()->uri == 'profiles'?'active': ''}}'><i class="icon ion-ios-information-outline"></i><a href="{{url('profiles')}}">  Basic Information</a></li>
              	<li class='{{Route::current()->uri == 'education'?'active': ''}}'><i class="icon ion-ios-briefcase-outline"></i><a href="{{url('education')}}">  Education and Work</a></li>
              	<li class='{{Route::current()->uri == 'interest'?'active': ''}}'><i class="icon ion-ios-heart-outline"></i><a href="{{url('interest')}}">  My Interests</a></li>
                <li class='{{Route::current()->uri == 'account'?'active': ''}}'><i class="icon ion-ios-settings"></i><a href="{{url('change-password')}}">  Account Settings</a></li>
              	<li class='{{Route::current()->uri == 'update'?'active': ''}}'><i class="icon ion-ios-locked-outline"></i><a href="{{url('change-password')}}">  Change Password</a></li>
              </ul>