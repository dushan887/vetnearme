@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit User Account
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Users</a></li>
        <li class="active">Edit User Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3" >

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="http://via.placeholder.com/250x250" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $user->first_name . " " . $user->last_name }}</h3>

              <p class="text-muted text-center"><a href="#"><strong>Vet Clinic</strong></a></p>

              <p class="text-muted text-center">{{ $user->position }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <i class="fa fa-envelope-square"></i> <a class="pull-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                  <i class="fa fa-phone-square"></i> <a class="pull-right">{{ $user->phone ?? "not available" }}</a>
                </li>
                <li class="list-group-item">
                  <i class="fa fa-globe"></i> <ul class="list-inline pull-right">
                            <li><a><i class="fa fa-facebook-square"></i></a></li>
                            <li><a><i class="fa fa-twitter"></i></a></li>
                            <li><a><i class="fa fa-linkedin"></i></a></li>
                            <li><a><i class="fa fa-instagram"></i></a></li>
                          </ul>
                </li>
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Message Me</b></a> --}}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="#about-me" data-toggle="tab">About Me</a></li>
              <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="about-me">
                <strong><i class="fa fa-file-text-o margin-r-5"></i> Bio</strong>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <hr>

                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                <p class="text-muted">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                <p class="text-muted">Sydney, Australia</p>


              </div>
              <!-- /.tab-pane -->

              <div class="active tab-pane" id="settings">
                <form class="form-horizontal"
                  action="/admin/users/update"
                  method="post"
                  enctype="multipart/form-data"
                >
                @csrf
                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>

                    <div class="col-sm-10">
                      <select id="title" name="title" class="form-control">
                        <option value=null></option>
                        @foreach($titles as $key => $value)
                          <option
                            value="{{ $value }}"
                            @if($value === $user->title)
                              selected="selected"
                            @endif
                          >{{ ucfirst($key) }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="first_name" name=first_name placeholder="First Name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="last_name" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name=last_name id="last_name" placeholder="Last Name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                      <select id="gender" name=gender class="form-control">
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="position" class="col-sm-2 control-label">Position</label>

                    <div class="col-sm-10">
                      <input type="text" name=position class="form-control" id="position" placeholder="Position">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input type="text" name=phone class="form-control" id="phone" placeholder="Phone Number">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="location" class="col-sm-2 control-label">Location</label>

                    <div class="col-sm-10">
                      <input type="text" name=location class="form-control" id="location" placeholder="Location">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="about" class="col-sm-2 control-label">Bio</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" name=about id="about" rows=10 placeholder="Bio"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="socialFacebook" class="col-sm-2 control-label">Facebook URL</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name=social[facebook] id="socialFacebook" placeholder="Facebook URL">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="scoialTwitter" class="col-sm-2 control-label">Twitter URL</label>

                    <div class="col-sm-10">
                      <input type="text" name=social[twitter] class="form-control" id="scoialTwitter" placeholder="Twitter URL">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="socialLinkedin" class="col-sm-2 control-label">Linkedin URL</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="social[linkedin]" id="socialLinkedin" placeholder="Linkedin URL">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="socialInstagram" class="col-sm-2 control-label">Instagram URL</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="social[instagram]" id="socialInstagram" placeholder="Instagram URL">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="avatar" class="col-sm-2 control-label">Profile Image</label>

                    <div class="col-sm-10">
                      <input type="file" name=avatar id="avatar">
                      <p class="help-block">Upload your profile image.</p>
                    </div>

                  </div>

                  <hr>

                  @if($user->hasRole('super_admin'))

                    <div class="form-group has-warning">
                      <label for="userType" class="col-sm-2 control-label">User Type</label>

                      <div class="col-sm-10">
                      <select id="userType" class="form-control">
                        <option>Super Admin</option>
                        <option>Admin</option>
                        <option>User</option>
                      </select>
                      </div>
                    </div>

                    <div class="form-group has-warning">
                      <label for="asignClinic" class="col-sm-2 control-label">Clinic</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="asignClinic" placeholder="Clinic Name">
                      </div>
                    </div>
                    <div class="form-group has-warning">
                      <label for="inputPaswoord" class="col-sm-2 control-label">Pasword</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPaswoord" placeholder="********">
                      </div>
                    </div>

                  @endif

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
@stop