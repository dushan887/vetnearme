<p>Welcome {{ $user->first_name . " " . $user->last_name }}<p>,

<p>An account is created for the VetNearMe service is created for you.</p>

<p> You can login with the temporary password <strong>{{ $tempPass }}</stron></p>

<p><a href="{{url('admin/profile')}}" class="btn bg-navy margin">View My Profile</a></p>
