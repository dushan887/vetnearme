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

        @if (Session::has('type'))
          @include('partials._alert')
        @endif

        <div class="col-md-3" >

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle"
                src="{{ $user->avatar ? '/avatars/thumbs/' . $user->avatar : 'http://via.placeholder.com/250x250' }}"
                alt="User profile picture">

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

                  <i class="fa fa-globe"></i>
                    <ul class="list-inline pull-right">
                      @if(isset($social['facebook']))
                        <li>
                          <a href="{{ $social['facebook'] }}"><i class="fa fa-facebook-square"></i></a>
                        </li>
                      @endif

                      @if(isset($social['twitter']))
                        <li>
                          <a href="{{ $social['twitter'] }}"><i class="fa fa-twitter"></i></a>
                        </li>
                      @endif

                      @if(isset($social['linkedin']))
                        <li>
                          <a href="{{ $social['linkedin'] }}"><i class="fa fa-linkedin"></i></a>
                        </li>
                      @endif

                      @if(isset($social['instagram']))
                        <li>
                          <a href="{{ $social['instagram'] }}"><i class="fa fa-instagram"></i></a>
                        </li>
                      @endif

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

                <p>{{$user->about}}</p>

                <hr>

                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                <p class="text-muted">{{$user->education}}</p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                <p class="text-muted">{{$user->location}}</p>


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
                  <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="first_name" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text"
                        class="form-control"
                        id="first_name"
                        value="{{ old('first_name') ?? $user->first_name }}"
                        name=first_name placeholder="First Name">

                        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text"
                        class="form-control"
                        name=last_name id="last_name"
                        value="{{ old('last_name') ?? $user->last_name }}"
                        placeholder="Last Name">
                        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">
                      <select id="gender" name=gender class="form-control">
                        <option value="0" {{ $user->gender === 0 ? "selected" : "" }}>Male</option>
                        <option value="1" {{ $user->gender === 1 ? "selected" : "" }}>Female</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
                    <label for="position" class="col-sm-2 control-label">Position</label>

                    <div class="col-sm-10">
                      <input type="text"
                      name=position
                      class="form-control"
                      value="{{ old('position') ?? $user->position }}"
                      id="position" placeholder="Position">
                      {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input type="text"
                        name=phone
                        class="form-control"
                        id="phone"
                        value="{{ old('phone') ?? $user->phone }}"
                        placeholder="Phone Number">
                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                    <label for="location" class="col-sm-2 control-label">Location</label>

                    <div class="col-sm-10">
                      <input type="text"
                        name=location
                        class="form-control"
                        id="location"
                        value="{{ old('location') ?? $user->location }}"
                        placeholder="Location">
                        {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
                    <label for="about" class="col-sm-2 control-label">Bio</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" name=about id="about" rows=10 placeholder="Bio">{{ old('about') ?? $user->about }}</textarea>
                      {!! $errors->first('about', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('social.facebook') ? 'has-error' : '' }}">
                    <label for="socialFacebook" class="col-sm-2 control-label">Facebook URL</label>

                    <div class="col-sm-10">
                      <input type="text"
                        class="form-control"
                        name=social[facebook]
                        id="socialFacebook"
                        value="{{ old('social.facebook') ?? $social['facebook'] ?? "" }}"
                        placeholder="Facebook URL">
                        {!! $errors->first('social.facebook', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('social.twitter') ? 'has-error' : '' }}">
                    <label for="scoialTwitter" class="col-sm-2 control-label">Twitter URL</label>

                    <div class="col-sm-10">
                      <input type="text"
                        name=social[twitter]
                        class="form-control"
                        id="scoialTwitter"
                        value="{{ old('social.twitter') ?? $social['twitter'] ?? "" }}"
                        placeholder="Twitter URL">
                        {!! $errors->first('social.twitter', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('social.linkedin') ? 'has-error' : '' }}">
                    <label for="socialLinkedin" class="col-sm-2 control-label">Linkedin URL</label>

                    <div class="col-sm-10">
                      <input type="text"
                        class="form-control"
                        name="social[linkedin]"
                        id="socialLinkedin"
                        value="{{ old('social.linkedin') ?? $social['linkedin'] ?? "" }}"
                        placeholder="Linkedin URL">
                        {!! $errors->first('social.linkedin', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('social.instagram') ? 'has-error' : '' }}">
                    <label for="socialInstagram" class="col-sm-2 control-label">Instagram URL</label>

                    <div class="col-sm-10">
                      <input type="text"
                        class="form-control"
                        name="social[instagram]"
                        id="socialInstagram"
                        value="{{ old('social.instagram') ?? $social['instagram'] ?? "" }}"
                         placeholder="Instagram URL">
                         {!! $errors->first('social.instagram', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                    <label for="avatar" class="col-sm-2 control-label">Profile Image</label>

                    <div class="col-sm-10">
                      <input type="file" name=avatar id="avatar">
                      <p class="help-block">Upload your profile image.</p>
                      {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                    </div>

                  </div>

                  <hr>

                  @if($user->hasRole('super_admin'))

                    <div class="form-group has-warning">
                      <label for="user_role" class="col-sm-2 control-label">User Type</label>

                      <div class="col-sm-10">
                        <select id="user_role" name="user_role" class="form-control">
                          <option value="super_admin"
                            @if($user->hasRole('super_admin'))
                              selected=selected
                            @endif
                          >Super Admin</option>
                          <option value="admin"
                            @if($user->hasRole('admin'))
                              selected=selected
                            @endif
                          >Admin</option>
                          <option value="user"
                            @if($user->hasRole('user'))
                              selected=selected
                            @endif
                          >User</option>
                        </select>
                      </div>
                    </div>

                    <admin-clinics-list></admin-clinics-list>

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