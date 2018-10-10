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

    <form class="form-horizontal" action="/admin/users/store" method="post" enctype="multipart/form-data">
        @csrf

      <div class="col-md-4">
        <button type="submit" class="btn btn-primary btn-block margin-bottom">Create</button>

        <div class="box box-primary">
          <div class="box-header">
            <h4 class="no-margin"><strong>User Info</strong></h4>
          </div>
          <hr class="no-margin">
          <div class="box-body">
            <div class="col-xs-12">

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group no-margin-bottom no-margin-right-md">
                    <label for="title" class="control-label">Title</label>
                      <select id="title" name="title" class="form-control">
                        <option></option>
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

                <div class="col-sm-8">
                  <div class="form-group no-margin-bottom {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="first_name" class="control-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" value="{{ old('first_name') }}" name=first_name
                        placeholder="First Name"> {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
              </div>

              <div class="form-group no-margin-bottom {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label for="last_name" class="control-label">Last Name</label>
                <input type="text" class="form-control" name=last_name id="last_name" value="{{ old('last_name') }}"
                  placeholder="Last Name"> {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group no-margin-bottom"  style="display: none !important">
                <label for="gender" class="control-label">Gender</label>
                  <select id="gender" name=gender class="form-control">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                  </select>
              </div>

              <div class="form-group no-margin-bottom {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="control-label">Email</label>
                  <input type="text" class="form-control" name=email id="email" value="{{ old('email') }}" placeholder="Email">
                  {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('temp_password') ? 'has-error' : '' }}">
                <label for="temp_password" class="control-label">Temporary Password</label>
                <div class="row">
                  <div class="col-sm-8 no-padding-right-md">
                    <input type="text" class="form-control" name=temp_password id="temp_password" value="{{ old('temp_password') }}" placeholder="Temporary Password" role=random-string>
                    {!! $errors->first('temp_password', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="col-sm-4">
                    <button type="button" class="btn btn-md btn-block btn-primary" @click="generateRandomString">
                      <i class="fa fa-refresh"></i>
                    </button>
                  </div>
                </div>

              </div>
              <div class="row">
                <hr class="no-margin">
              </div>
              <div class="form-group">
                {{-- <div class="col-sm-offset-2 col-sm-10"> --}}
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                  </div>
                {{-- </div> --}}
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header">
            <h4 class="no-margin"><strong>Aditional Info</strong></h4>
          </div>
          <hr class="no-margin">
          <div class="box-body">
            <div class="col-xs-12">

              <div class="form-group no-margin-bottom {{ $errors->has('avatar') ? 'has-error' : '' }}">
                <label for="avatar" class="control-label">Profile Image</label>
                  <input type="file" name=avatar id="avatar">
                  <p class="help-block">Upload your profile image.</p>
                  {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="row">
                <hr class="no-margin">
              </div>

              <div class="form-group no-margin-bottom {{ $errors->has('position') ? 'has-error' : '' }}">
                <label for="position" class="control-label">Position</label>
                  <input type="text" name=position class="form-control" value="{{ old('position') }}" id="position" placeholder="Position">
                  {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group no-margin-bottom {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone" class="control-label">Phone</label>
                  <input type="text" name=phone class="form-control" id="phone" value="{{ old('phone') }}" placeholder="Phone Number">
                  {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group no-margin-bottom {{ $errors->has('location') ? 'has-error' : '' }}">
                <label for="location" class="control-label">Location</label>
                  <input type="text" name=location class="form-control" id="location" value="{{ old('location')}}" placeholder="Location">
                  {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group no-margin-bottom {{ $errors->has('about') ? 'has-error' : '' }}">
                <label for="about" class="control-label">Bio</label>
                  <textarea class="form-control" name=about id="about" rows=5 placeholder="Bio">{{ old('about') }}</textarea>
                  {!! $errors->first('about', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group  {{ $errors->has('education') ? 'has-error' : '' }}">
                <label for="education" class="control-label">Education</label>
                  <textarea class="form-control" name=education id="education" rows=3 placeholder="Education">{{ old('education') }}</textarea>
                  {!! $errors->first('education', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="row">
                <h5><strong>Social</strong></h5>
                <hr class="no-margin-top">
              </div>

              <div class="form-group {{ $errors->has('social.facebook') ? 'has-error' : '' }}">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                  <input type="text" class="form-control" name=social[facebook] id="socialFacebook" value="{{ old('social.facebook') }}" placeholder="Facebook URL">
                  {!! $errors->first('social.facebook', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

              <div class="form-group {{ $errors->has('social.twitter') ? 'has-error' : '' }}">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                  <input type="text" name=social[twitter] class="form-control" id="scoialTwitter" value="{{ old('social.twitter') }}" placeholder="Twitter URL">
                  {!! $errors->first('social.twitter', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

              <div class="form-group {{ $errors->has('social.linkedin') ? 'has-error' : '' }}">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                  <input type="text" class="form-control" name="social[linkedin]" id="socialLinkedin" value="{{ old('social.linkedin') }}" placeholder="Linkedin URL">
                    {!! $errors->first('social.linkedin', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

              <div class="form-group {{ $errors->has('social.instagram') ? 'has-error' : '' }}">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                  <input type="text" class="form-control" name="social[instagram]" id="socialInstagram" value="{{ old('social.instagram') }}" placeholder="Instagram URL">
                  {!! $errors->first('social.instagram', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>



      <div class="col-md-4">
        @if(\Auth::user()->hasRole('super_admin', 'admin'))
        <div class="box box-primary">
          <div class="box-header">
            <h4 class="no-margin"><strong>Admin Settings</strong></h4>
          </div>
          <hr class="no-margin">
          <div class="box-body">
            <div class="col-xs-12">
              <div class="form-group has-warning">
                <label for="user_role" class="control-label">User Type</label>
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
          </div>
        </div>
        @endif

        @if(\Auth::user()->hasRole('super_admin'))
        <div class="box box-primary">
          <div class="box-header">
            <h4 class="no-margin"><strong>Super Admin Settings</strong></h4>
          </div>
          <hr class="no-margin">
          <div class="box-body">
            <div class="col-xs-12">
              <div class="row"><p class="help-block"><strong>Assign user as the owner of the clinic</strong></p></div>
              <admin-clinics-list :clinicrole="'owner'"></admin-clinics-list>
              <div class="row"><p class="help-block"><strong>Assign user to the clinic</strong></p></div>
              <admin-clinics-list :clinicrole="'user'"></admin-clinics-list>
            </div>
          </div>
        </div>
        @endif

    </div>
    <!-- /.col -->
  </form>

</section>

@stop