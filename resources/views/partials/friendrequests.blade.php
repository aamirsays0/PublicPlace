              <h4 class="grey" style="font-weight: 600;">Friend Requests</h4>
              <hr>
              @forelse($requests as $req)
               <div class="follow-user">
               @if (file_exists(public_path('storage/profile/'.$req->user_id.'_profile.jpg')) )
                <img src="{{asset('storage/profile/'.$req->user_id.'_profile.jpg')}}" alt="" class="profile-photo-sm pull-left" />
                @else
                <img src="{{ asset('images/noimage.jpg') }}" class="profile-photo-sm pull-left" id="noimage" alt="">
                @endif
                <div>
                  <h6><a href="{{url('profiles/'.$req->user->id)}}">{{isset($req->user->profiles->f_name, $req->user->profiles->l_name)? $req->user->profiles->f_name.' '. $req->user->profiles->l_name: $req->user->name}}</a></h6>
                  <a class="confirmBtn text-green" data-uid="{{$req->user_id}}" href="javascript:void(0)">Confirm</a>
                  <a class="deleteBtn text-danger" data-uid="{{$req->id}}"  href="javascript:void(0)">Delete</a>
                </div>
               </div>
              @empty
              <h5 style="position: relative; left: 10%;">No Friend Requests</h5>
              @endforelse
   