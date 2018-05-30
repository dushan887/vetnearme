@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create New User Account
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Users</a></li>
    <li class="active">Create New User Account</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">

    @if (Session::has('type'))
      @include('partials._alert')
    @endif

    <div class="col-md-12">

      <form class="form-horizontal" action="/admin/users/store" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>

          <div class="col-sm-10">
            <select id="title" name="title" class="form-control">
                  <option value=null></option>
                  @foreach($titles as $key => $value)
                    <option
                      value="{{ $value }}"
                      @if(old('title') === $value)
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
            <input type="text" class="form-control" id="first_name" value="{{ old('first_name') }}" name=first_name
              placeholder="First Name"> {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
          <label for="last_name" class="col-sm-2 control-label">Last Name</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name=last_name id="last_name" value="{{ old('last_name') }}"
              placeholder="Last Name"> {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
          <label for="email" class="col-sm-2 control-label">Email</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name=email id="email" value="{{ old('email') }}" placeholder="Email">
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('temp_password') ? 'has-error' : '' }}">
          <label for="temp_password" class="col-sm-2 control-label">Temporary Password</label>

          <div class="col-sm-1">
            <button type="button" class="btn btn-xs btn-primary" @click="generateRandomString">Generate Password</button>
          </div>

          <div class="col-sm-9">
            <input type="text" class="form-control" name=temp_password id="temp_password" value="{{ old('temp_password') }}" placeholder="Temporary Password" role=random-string>
            {!! $errors->first('temp_password', '<p class="help-block">:message</p>') !!}
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

        <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
          <label for="position" class="col-sm-2 control-label">Position</label>

          <div class="col-sm-10">
            <input type="text" name=position class="form-control" value="{{ old('position') }}" id="position" placeholder="Position">
            {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
          <label for="phone" class="col-sm-2 control-label">Phone</label>

          <div class="col-sm-10">
            <input type="text" name=phone class="form-control" id="phone" value="{{ old('phone') }}" placeholder="Phone Number">
            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
          <label for="location" class="col-sm-2 control-label">Location</label>

          <div class="col-sm-10">
            <input type="text" name=location class="form-control" id="location" value="{{ old('location')}}" placeholder="Location">
            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
          <label for="about" class="col-sm-2 control-label">Bio</label>

          <div class="col-sm-10">
            <textarea class="form-control" name=about id="about" rows=10 placeholder="Bio">{{ old('about') }}</textarea>
            {!! $errors->first('about', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('social.facebook') ? 'has-error' : '' }}">
          <label for="socialFacebook" class="col-sm-2 control-label">Facebook URL</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name=social[facebook] id="socialFacebook" value="{{ old('social.facebook') }}" placeholder="Facebook URL">
            {!! $errors->first('social.facebook', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('social.twitter') ? 'has-error' : '' }}">
          <label for="scoialTwitter" class="col-sm-2 control-label">Twitter URL</label>

          <div class="col-sm-10">
            <input type="text" name=social[twitter] class="form-control" id="scoialTwitter" value="{{ old('social.twitter') }}" placeholder="Twitter URL">
            {!! $errors->first('social.twitter', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('social.linkedin') ? 'has-error' : '' }}">
          <label for="socialLinkedin" class="col-sm-2 control-label">Linkedin URL</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name="social[linkedin]" id="socialLinkedin" value="{{ old('social.linkedin') }}" placeholder="Linkedin URL">
            {!! $errors->first('social.linkedin', '<p class="help-block">:message</p>') !!}
          </div>

        </div>

        <div class="form-group {{ $errors->has('social.instagram') ? 'has-error' : '' }}">
          <label for="socialInstagram" class="col-sm-2 control-label">Instagram URL</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name="social[instagram]" id="socialInstagram" value="{{ old('social.instagram') }}" placeholder="Instagram URL">
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

        @if(\Auth::user()->hasRole('super_admin', 'admin'))

          <div class="form-group has-warning">
            <label for="user_role" class="col-sm-2 control-label">User Type</label>

            <div class="col-sm-10">
              <select id="user_role" name="user_role" class="form-control">
                @if(\Auth::user()->hasRole('super_admin'))
                  <option value="super_admin"
                  @if(old('user_role') === 'super_admin')
                    selected="selected"
                  @endif
                  >Super Admin</option>
                @endif
                  <option value="admin"
                    @if(old('user_role') === 'admin')
                      selected="selected"
                    @endif
                  >Admin</option>
                  <option value="user"
                    @if(old('user_role') === 'user')
                      selected="selected"
                    @endif
                  >User</option>
                </select>
            </div>
          </div>

        @endif

        @if(\Auth::user()->hasRole('super_admin'))
          <p class="help-block col-md-offset-2"><strong>Assign user as the owner of the clinic</stri></p>
          <admin-clinics-list :clinicrole="'owner'"></admin-clinics-list>

          <p class="help-block col-md-offset-2"><strong>Assign user to the clinic</stri></p>
          <admin-clinics-list :clinicrole="'user'"></admin-clinics-list>
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
  <!-- /.col -->

</section>

@stop