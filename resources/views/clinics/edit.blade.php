@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Clinic <small>{{ $clinic->name }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Clinic</a></li>
    <li class="active">Edit Clinic</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  @if (Session::has('alert'))
    @include('partial/_alert')
  @endif

  <form class="form-horizontal"
      action="/admin/clinics/update/{{ $clinic->id }}" method=post role=form enctype="multipart/form-data">
    @csrf

    <div class="row">
      <div class="col-md-4">
        <div class="box box-primary padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#clinic_info" data-toggle="tab">Info</a></li>
            <li><a href="#clinic_location" data-toggle="tab">Location</a></li>
            <li><a href="#clinic_social" data-toggle="tab">Social</a></li>
            <li><a href="#clinic_opening_hours" data-toggle="tab">Opening Hours</a></li>
            <li><a href="#clinic_services" data-toggle="tab">Services</a></li>
            <li><a href="#clinic_media" data-toggle="tab">Media</a></li>
            <li><a href="#clinic_staff" data-toggle="tab">Staff</a></li>
            <li><a href="#clinic_booking" data-toggle="tab">Booking Forms</a></li>
          </ul>
          <div class="box-body">
            <div class="col-md-12">

              <div class="form-group {{ $errors->has('general_practice') ? 'has-error' : ''}}">
                <label style="display: block">
                      General practice
                      <input type="checkbox"
                      value="true"
                      name=general_practice
                      class="minimal pull-right"
                       @if($clinic->general_practice)
                        checked
                      @endif>
                    </label> {!! $errors->first('general_practice', '
                <p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('specialist_and_emergency') ? 'has-error' : ''}}">
                <label style="display: block">
                      Specialist and Emergency
                      <input type="checkbox"
                      value="true" name="specialist_and_emergency"
                      class="minimal pull-right"
                      @if($clinic->specialist_and_emergency)
                        checked
                      @endif>
                    </label> {!! $errors->first('specialist_and_emergency', '
                <p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('subscribe') ? 'has-error' : ''}}">
                <label style="display: block">
                      Subscribe <em>For testing purposes</em>
                      <input type="checkbox"
                        value="true"
                        name="subscribe"
                        class="minimal pull-right"
                        @if($clinic->subscribe)
                        checked
                      @endif>
                    </label> {!! $errors->first('subscribe', '
                <p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('accessibility') ? 'has-error' : ''}}">
                <label style="display: block">
                      Wheelchair Accessible
                      <input type="checkbox"
                      value="true" name="accessibility"
                      class="minimal pull-right"
                      @if($clinic->accessibility)
                        checked
                      @endif>
                    </label> {!! $errors->first('accessibility', '<p class="help-block">:message</p>') !!}
              </div>

            </div>

            <button type="submit" class="btn btn-primary">Update Clinic</button>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="tab-content">
          <div class="active tab-pane" id="clinic_info">
            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Info</h3>
              </div>


              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for=name>Clinic Name</label>
                    <input type="text" id=name name=name class="form-control" placeholder="Clinic Name"
                      value="{{ old('name') ?? $clinic->name}}">
                      {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    <label for=description>Description</label>
                    <textarea class="form-control" id=description name=description placeholder="Description">{{ old('description') ?? $clinic->description }}</textarea>
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for=email>Email Address</label>
                    <input type="email" id=email name=email class="form-control"
                      placeholder="Email"
                      value="{{ $clinic->email }}">
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                    <label name=phone_number>Phone Number</label>
                    <input type="text" id=phone_number name=phone_number class="form-control"
                    placeholder="Phone Number"
                    value="{{ old('phone_number') ?? $clinic->phone_number }}">
                    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('hours.emergency_number') ? 'has-error' : ''}}">
                    <label for=emergency_number>Emergency Number</label>
                    <input type="text" id=emergency_number name=emergency_number class="form-control" placeholder="Emergency Number"
                    value="{{ old('emergency_number') ?? $clinic->emergency_number }}">
                    {!! $errors->first('emergency_number', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
                    <label for=url>Web URL</label>
                    <input type="text" id=url name=url class="form-control" placeholder="Web URL"
                    value="{{ old('url') ?? $clinic->url }}">
                    {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="clinic_location">
            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Location</h3>
              </div>


              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                    <label for=city>City</label>
                    <input type="text" id=city name=city class="form-control"
                      placeholder="City"
                      value="{{ old('city') ?? $clinic->city }}">
                    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                    <label for=address>Address</label>
                    <input type="text" id=address name=address class="form-control" placeholder="Address"
                      value="{{ old('address') ?? $clinic->address }}">
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('zip') ? 'has-error' : ''}}">
                    <label for=zip>Postal Code</label>
                    <input type="text" id=zip name=zip class="form-control"
                      placeholder="Postal Code"
                      value="{{ old('zip') ?? $clinic->zip }}">
                    {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group">
                    <label for=country_id>Country</label>
                    <select name="country_id" id="country_id" class="form-control">
                        @foreach($countries as $key => $value)
                          <option value="{{ $key }}"
                            <?php
                              if( $key === old('country_id') || $key === $clinic->country_id ) echo "selected=selected"
                            ?>>
                            {{$value}}
                          </option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
                    <label for=state>Postal Code</label>
                    <input type="text" id=state name=state class="form-control" placeholder="State"
                      value="{{ old('state') ?? $clinic->state }}">
                      {!! $errors->first('state','<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('gmaps_link') ? 'has-error' : ''}}">
                    <label for=g maps_link>Google Map URL</label>
                    <input type="text" id=g maps_link id=g maps_link class="form-control"
                      placeholder="Google Map URL"
                      value="{{ old('gmaps_link') ?? $clinic->gmaps_link }}">
                      {!! $errors->first('gmaps_link', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group">
                    <label for=g maps_link>Latitude</label>
                    <input type="text" id="latitude" class="form-control"
                    readonly
                    placeholder="Latitude"
                      value="{{ $clinic->lat }}">
                  </div>

                  <div class="form-group">
                    <label for=g maps_link>Longitude</label>
                    <input type="text" id="Llngitude" class="form-control"
                    readonly
                    placeholder="Longitude"
                      value="{{ $clinic->lng }}">
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="clinic_social">

            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Social</h3>
              </div>

              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group {{ $errors->has('social.facebook') ? 'has-error' : ''}}">
                    <label for=socialFacebook>Facebook</label>
                    <input type="text" id=socialFacebook name=social[facebook] class="form-control" placeholder="Facebook"
                      value="{{ old('social.facebook') ?? $social->facebook ?? ''}}">
                      {!! $errors->first('social.facebook', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('social.twitter') ? 'has-error' : ''}}">
                    <label for=socialTwitter>Twitter</label>
                    <input type="text" id=socialTwitter name=social[twitter] class="form-control"
                      placeholder="Twitter"
                      value="{{ old('social.twitter') ?? $social->twitter ?? '' }}">
                    {!! $errors->first('social.twitter', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('hours.social.twitter') ? 'has-error' : ''}}">
                    <label for=socialInstagram>Instagram</label>
                    <input type="text" id=socialInstagram name=social[instagram] class="form-control" placeholder="Instagram" value="{{ old('social.instagram') }}">
                    {!! $errors->first('social.instagram', '
                    <p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('social.linkedin') ? 'has-error' : ''}}">
                    <label for=socialLinkedin>Linkedin</label>
                    <input type="text" id=socialLinkedin name=social[linkedin] class="form-control"
                      placeholder="Linkedin"
                      value="{{ old('social.linkedin') ?? $social->linkedin ?? '' }}">
                    {!! $errors->first('social.linkedin', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {{ $errors->has('social.youtube') ? 'has-error' : ''}}">
                    <label for=socialYoutube>YouTube</label>
                    <input type="text" id=socialYoutube name=social[youtube] class="form-control"
                      placeholder="YouTube"
                      value="{{ old('social.youtube') ?? $social->youtube ?? '' }}">
                      {!! $errors->first('social.youtube', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="clinic_opening_hours">
            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Opening Hours</h3>
              </div>

              <div class="box-body">
                <div class="col-md-12">
                  <div class="row" data-hoursday=monday>
                    <div class="color-palette-set">
                      <div class="bg-light-blue color-palette">
                        <div class="row no-margin">
                          <div class="col-xs-6">
                            <strong>Monday</strong>
                          </div>
                          <div class="col-xs-6" align="right">
                            <label for="not-working-monday" class="no-margin">
                              <span>Closed</span>
                              <input type="checkbox" name="not-working[monday]"
                                value=monday
                                id=not-working-monday
                                @change="notWorking('monday')">
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.monday-from') ? 'has-error' : ''}}">
                        <label for=hoursMondayFrom>From</label>
                        <input type="text" id=hoursMonday name=hours[monday-from]
                          value="{{ $hours->{'monday-from'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.monday-from', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.monday-to') ? 'has-error' : ''}}">
                        <label for=hoursMondayTo>To</label>
                        <input type="text" id=hoursMondayTo name=hours[monday-to]
                          value="{{ $hours->{'monday-to'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.monday-to', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.monday-from2') ? 'has-error' : ''}}">
                        <label for=hoursMondayFrom2>From</label>
                        <input type="text" id=hoursMondayFrom2 name=hours[monday-from2]
                          value="{{ $hours->{'monday-from2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.monday-from2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.monday-to2') ? 'has-error' : ''}}">
                        <label for=hoursMondayTo2>To</label>
                        <input type="text" id=hoursMondayTo2 name=hours[monday-to2]
                          value="{{ $hours->{'monday-to2'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.monday-to2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>
                  </div>

                  <div class="row" data-hoursday=tuesday>
                    <div class="color-palette-set">
                      <div class="bg-light-blue color-palette">
                        <div class="row no-margin">
                          <div class="col-xs-6">
                            <strong>Tuesday</strong>
                          </div>
                          <div class="col-xs-6" align="right">
                            <label for="not-working-tuesday" class="no-margin">
                                <span>Closed</span>
                                <input type="checkbox" name="not-working[tuesday]"
                                  value=tuesday id=not-working-tuesday @change="notWorking('tuesday')">
                              </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.tuesday-from') ? 'has-error' : ''}}">
                        <label for=hoursTuesdayFrom>From</label>
                        <input type="text" id=hoursTuesdayFrom name=hours[tuesday-from]
                          value="{{ $hours->{'tuesday-from'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.tuesday-from', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.tuesday-to') ? 'has-error' : ''}}">
                        <label for=hoursTuesdayTo>To</label>
                        <input type="text" id=hoursTuesdayTo name=hours[tuesday-to]
                          value="{{ $hours->{'tuesday-to'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.tuesday-to', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.tuesday-from2') ? 'has-error' : ''}}">
                        <label for=hoursTuesdayFrom2>From</label>
                        <input type="text" id=hoursTuesdayFrom2 name=hours[tuesday-from2]
                        value="{{ $hours->{'tuesday-from2'} ?? "06:00" }}"
                        class="form-control timepicker">
                        {!! $errors->first('hours.tuesday-from2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.tuesday-to2') ? 'has-error' : ''}}">
                        <label for=hoursTuesdayTo2>To</label>
                        <input type="text" id=hoursTuesdayTo2 name=hours[tuesday-to2]
                          value="{{ $hours->{'tuesday-to2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.tuesday-to2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>
                  </div>

                  <div class="row" data-hoursday=wednesday>
                    <div class="color-palette-set">
                      <div class="bg-light-blue color-palette">
                        <div class="row no-margin">
                          <div class="col-xs-6">
                            <strong>Wednesday</strong>
                          </div>
                          <div class="col-xs-6" align="right">
                            <label for="not-working-wednesday" class="no-margin">
                              <span>Closed</span>
                              <input type="checkbox" name="not-working[wednesday]" value=wednesday id=not-working-wednesday @change="notWorking('wednesday')">
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.wednesday-from') ? 'has-error' : ''}}">
                        <label for=hoursWednesdayFrom>From</label>
                        <input type="text"
                          id=hoursWednesdayFrom name=hours[wednesday-from]
                          value="{{ $hours->{'wednesday-from'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.wednesday-from', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.wednesday-to') ? 'has-error' : ''}}">
                        <label for=hoursWednesdayTo>To</label>
                        <input type="text" id=hoursWednesdayTo name=hours[wednesday-to]
                          value="{{ $hours->{'wednesday-to'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.wednesday-to', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.wednesday-from2') ? 'has-error' : ''}}">
                        <label for=hoursWednesdayFrom2>From</label>
                        <input type="text" id=hoursWednesdayFrom2 name=hours[wednesday-from2]
                          value="{{ $hours->{'wednesday-from2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.wednesday-from2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.wednesday-to2') ? 'has-error' : ''}}">
                        <label for=hoursWednesdayTo2>To</label>
                        <input type="text" id=hoursWednesdayTo2 name=hours[wednesday-to2]
                          value="{{ $hours->{'wednesday-to2'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.wednesday-to2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>
                  </div>

                  <div class="row" data-hoursday=thursday>
                    <div class="color-palette-set">
                      <div class="bg-light-blue color-palette">
                        <div class="row no-margin">
                          <div class="col-xs-6">
                            <strong>Thursday</strong>
                          </div>
                          <div class="col-xs-6" align="right">
                            <label for="not-working-thursday" class="no-margin">
                                <span>Closed</span>
                                <input type="checkbox" name="not-working[thursday]" value=thursday id=not-working-thursday @change="notWorking('thursday')">
                              </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.thursday-from') ? 'has-error' : ''}}">
                        <label for=hoursThursdayFrom>From</label>
                        <input type="text" id=hoursThursdayFrom name=hours[thursday-from]
                          value="{{ $hours->{'thursday-from'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.thursday-from', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.thursday-to') ? 'has-error' : ''}}">
                        <label for=hoursThursdayTo>To</label>
                        <input type="text" id=hoursThursdayTo name=hours[thursday-to]
                          value="{{ $hours->{'thursday-to'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.thursday-to', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.thursday-from2') ? 'has-error' : ''}}">
                        <label for=hoursThursdayFrom2>From</label>
                        <input type="text" id=hoursThursdayFrom2 name=hours[thursday-from2]
                          value="{{ $hours->{'thursday-from2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.thursday-from2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.thursday-to2') ? 'has-error' : ''}}">
                        <label for=hoursThursdayTo2>To</label>
                        <input type="text" id=hoursThursdayTo2 name=hours[thursday-to2]
                          value="{{ $hours->{'thursday-to2'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.thursday-to2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>
                  </div>

                  <div class="row" data-hoursday=friday>
                    <div class="color-palette-set">
                      <div class="bg-light-blue color-palette">
                        <div class="row no-margin">
                          <div class="col-xs-6">
                            <strong>Friday</strong>
                          </div>
                          <div class="col-xs-6" align="right">
                            <label for="not-working-friday" class="no-margin">
                              <span>Closed</span>
                              <input type="checkbox" name="not-working[friday]" value=friday id=not-working-friday @change="notWorking('friday')">
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.friday-from') ? 'has-error' : ''}}">
                        <label for=hoursFridayFrom>From</label>
                        <input type="text" id=hoursFridayFrom name=hours[friday-from]
                          value="{{ $hours->{'friday-from'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.friday-from', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.friday-to') ? 'has-error' : ''}}">
                        <label for=hoursFridayTo>To</label>
                        <input type="text" id=hoursFridayTo name=hours[friday-to]
                          value="{{ $hours->{'friday-to'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.friday-to', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.friday-from2') ? 'has-error' : ''}}">
                        <label for=hoursFridayFrom2>From</label>
                        <input type="text" id=hoursFridayFrom2 name=hours[friday-from2]
                          value="{{ $hours->{'friday-from2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.friday-from2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.friday-to2') ? 'has-error' : ''}}">
                        <label for=hoursFridayTo2>To</label>
                        <input type="text"
                          id=hoursFridayTo2
                          name=hours[friday-to2]
                          value="{{ $hours->{'friday-to2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.friday-to2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                  </div>

                  <div class="row" data-hoursday=saturday>
                    <div class="color-palette-set">
                      <div class="bg-light-blue color-palette">
                        <div class="row no-margin">
                          <div class="col-xs-6">
                            <strong>Saturday</strong>
                          </div>
                          <div class="col-xs-6" align="right">
                            <label for="not-working-saturday" class="no-margin">
                                <span>Closed</span>
                                <input type="checkbox" name="not-working[saturday]" value=saturday id=not-working-saturday @change="notWorking('saturday')">
                              </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.saturday-from') ? 'has-error' : ''}}">
                        <label for=hoursSaturdayFrom>From</label>
                        <input type="text" id=hoursSaturdayFrom name=hours[saturday-from]
                          value="{{ $hours->{'saturday-from'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.saturday-from', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.saturday-to') ? 'has-error' : ''}}">
                        <label for=hoursSaturdayTo>To</label>
                        <input type="text" id=hoursSaturdayTo name=hours[saturday-to]
                          value="{{ $hours->{'saturday-to'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.saturday-to', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.saturday-from2') ? 'has-error' : ''}}">
                        <label for=hoursSaturdayFrom2>From</label>
                        <input type="text" id=hoursSaturdayFrom2 name=hours[saturday-from2]
                          value="{{ $hours->{'saturday-from2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.saturday-from2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.saturday-to2') ? 'has-error' : ''}}">
                        <label for=hoursSaturdayTo2>To</label>
                        <input type="text" id=hoursSaturdayTo2 name=hours[saturday-to2]
                          value="{{ $hours->{'saturday-to2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.saturday-to2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                  </div>

                  <div class="row" data-hoursday=sunday>
                    <div class="color-palette-set">
                      <div class="bg-light-blue color-palette">
                        <div class="row no-margin">
                          <div class="col-xs-6">
                            <strong>Sunday</strong>
                          </div>
                          <div class="col-xs-6" align="right">
                            <label for="not-working-sunday" class="no-margin">
                              <span>Closed</span>
                              <input type="checkbox" name="not-working[sunday]" value=sunday id=not-working-sunday @change="notWorking('sunday')">
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.sunday-from') ? 'has-error' : ''}}">
                        <label for=hoursSundayFrom>From</label>
                        <input type="text" id=hoursSundayFrom name=hours[sunday-from]
                          value="{{ $hours->{'sunday-from'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.sunday-from', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.sunday-to') ? 'has-error' : ''}}">
                        <label for=hoursSundayTo>To</label>
                        <input type="text" id=hoursSundayTo name=hours[sunday-to]
                          value="{{ $hours->{'sunday-to'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.sunday-to', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.sunday-from2') ? 'has-error' : ''}}">
                        <label for=hoursSundayFrom2>From</label>
                        <input type="text" id=hoursSundayFrom2 name=hours[sunday-from2]
                          value="{{ $hours->{'sunday-from2'} ?? "06:00" }}"
                          class="form-control timepicker">
                          {!! $errors->first('hours.sunday-from2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                      <div class="form-group {{ $errors->has('hours.sunday-to2') ? 'has-error' : ''}}">
                        <label for=hoursSundayTo2>To</label>
                        <input type="text" id=hoursSundayTo2 name=hours[sunday-to2]
                          value="{{ $hours->{'sunday-to2'} ?? "06:00" }}"
                          class="form-control timepicker">
                        {!! $errors->first('hours.sunday-to2', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                  </div>

                  <div class="form-group {{ $errors->has('special_notes') ? 'has-error' : ''}}">
                    <label for=special_notes>Special Notes</label>
                    <input type="text" id=special_notes name=special_notes class="form-control"
                      placeholder="Special Notes"
                      value="{{ old('special_notes') ?? $clinic->special_notes }}">
                  </div>


                </div>
              </div>

            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="clinic_services">
            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Services</h3>
              </div>


              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="services">Services</label>
                    <select name="services[]" id="services" multiple class="form-control">
                        @foreach($services as $key => $value)
                          <option value="{{ $value }}"
                          @if(in_array($value, $clinicServices))
                            selected
                          @endif>
                            {{ $key }}
                          </option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="clinic_media">
            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Media</h3>
              </div>

              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                    <label for="logo">Clinic Logo</label>
                    <input type="file" id="logo" name=logo>
                  </div>

                  <h3>Current Logo</h3>
                  <img src="/img/logo/{{ $clinic->logo }}" alt="Current Logo" class="clinic-current-logo">
                </div>
              </div>

              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group {{ $errors->has('marker') ? 'has-error' : ''}}">
                    <label for="marker">Clinic Marker</label>
                    <input type="file" id="marker" name=marker>
                  </div>

                  <h3>Current Marker</h3>
                  <img src="/img/markers/{{ $clinic->marker }}" alt="Current Marker">
                </div>
              </div>

            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="clinic_staff">
            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Staff</h3>
              </div>

              <div class="box-body">

                <ul class="clinic-members">
                  @foreach($clinic->users as $member)
                    <li>{{ $member->first_name }} {{ $member->last_name }}</li>
                  @endforeach
                </ul>

              </div>

            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="clinic_booking">
            <div class="box box-primary padding">
              <div class="box-header">
                <h3 class="box-title">Booking Forms</h3>
              </div>


              <div class="box-body"></div>

            </div>
          </div>
          <!-- /.tab-pane -->

        </div>

        <!-- /.nav-tabs-custom -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </form>

</section>

@stop