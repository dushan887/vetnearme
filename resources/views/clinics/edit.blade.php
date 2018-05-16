@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Clinic
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Clinic</a></li>
        <li class="active">New Clinic</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-8 col-md-offset-2">
          <div class="box box-primary padding">
            <div class="box-header">
              <h3 class="box-title">Edit Clinic</h3>
            </div>

            @if (Session::has('type'))
              @include('partials._alert')
            @endif

            <div class="box-body">
              <form class="form-horizontal"
                action="/admin/clinics/update/{{ $clinic->id }}"
                method=post
                role=form
                enctype="multipart/form-data"
              >
              @csrf

                  <div class="col-md-12">

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                      <label for=name>Clinic Name</label>
                      <input type="text" id=name name=name class="form-control" placeholder="Clinic Name" value="{{ $clinic->name }}">
                      {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                      <label for=description>Description</label>
                      <textarea class="form-control" id=description name=description placeholder="Description">{{ $clinic->description }}</textarea>
                      {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                      <label for=email>Email Address</label>
                      <input type="email" id=email name=email class="form-control" placeholder="Email" value="{{ $clinic->email }}">
                      {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                      <label name=phone_number>Phone Number</label>
                      <input type="text" id=phone_number name=phone_number class="form-control" placeholder="Phone Number" value="{{ $clinic->phone_number }}">
                      {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('hours.emergency_number') ? 'has-error' : ''}}">
                      <label for=emergency_number>Emergency Number</label>
                      <input type="text" id=emergency_number name=emergency_number class="form-control" placeholder="Emergency Number" value="{{ $clinic->emergency_number }}">
                      {!! $errors->first('emergency_number', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
                      <label for=url>Web URL</label>
                      <input type="text" id=url name=url class="form-control" placeholder="Web URL" value="{{ $clinic->url }}">
                      {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
                    </div>

                    <hr>

                    <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                      <label for=city>City</label>
                      <input type="text" id=city name=city class="form-control" placeholder="City" value="{{ $clinic->city }}">
                      {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                      <label for=address>Address</label>
                      <input type="text" id=address name=address class="form-control" placeholder="Address" value="{{ $clinic->address }}">
                      {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('zip') ? 'has-error' : ''}}">
                      <label for=zip>Postal Code</label>
                      <input type="text" id=zip name=zip class="form-control" placeholder="Postal Code" value="{{ $clinic->zip }}">
                      {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group">
                      <label for=country_id>Country</label>
                      <select name="country_id" id="country_id" class="form-control">
                        @foreach($countries as $key => $value)
                          <option value="{{ $key }}"
                            <?php
                                if($key === $country_id) echo "selected=selected"
                            ?>
                          >{{$value}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group {{ $errors->has('gmaps_link') ? 'has-error' : ''}}">
                      <label for= gmaps_link>Google Map URL</label>
                      <input type="text" id= gmaps_link id= gmaps_link class="form-control" placeholder="Google Map URL" value="{{ $clinic->gmaps_link }}">
                      {!! $errors->first('gmaps_link', '<p class="help-block">:message</p>') !!}
                    </div>

                    <hr>

                    <div class="form-group {{ $errors->has('social.facebook') ? 'has-error' : ''}}">
                      <label for=socialFacebook>Facebook</label>
                      <input type="text" id=socialFacebook name=social[facebook] class="form-control" placeholder="Facebook" value="{{ $social['facebook'] ?? '' }}">
                      {!! $errors->first('social.facebook', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('social.twitter') ? 'has-error' : ''}}">
                      <label for=socialTwitter>Twitter</label>
                      <input type="text" id=socialTwitter name=social[twitter] class="form-control" placeholder="Twitter" value="{{ $social['twitter'] ?? :: }}">
                      {!! $errors->first('social.twitter', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('hours.social.twitter') ? 'has-error' : ''}}">
                      <label for=socialInstagram>Instagram</label>
                      <input type="text" id=socialInstagram name=social[instagram] class="form-control" placeholder="Instagram" value="{{ $social['instagram'] ?? '' }}">
                      {!! $errors->first('social.instagram', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('social.linkedin') ? 'has-error' : ''}}">
                      <label for=socialLinkedin>Linkedin</label>
                      <input type="text" id=socialLinkedin name=social[linkedin] class="form-control" placeholder="Linkedin" value="{{ $social['linkedin'] ?? '' }}">
                      {!! $errors->first('social.linkedin', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('social.youtube') ? 'has-error' : ''}}">
                      <label for=socialYoutube>YouTube</label>
                      <input type="text" id=socialYoutube name=social[youtube] class="form-control" placeholder="YouTube" value="{{ $social['youtube'] ?? '' }}">
                      {!! $errors->first('social.youtube', '<p class="help-block">:message</p>') !!}
                    </div>

                    <hr>

                    <div class="row" data-hoursday=monday>
                      <p  align="center">
                        <strong>Monday</strong>
                      </p>

                      <p class=text-center>
                        <label for="not-working-monday">
                          <input type="checkbox"
                             name="not-working[monday]"
                             value=monday id=not-working-monday
                             @change="notWorking('monday')"
                             <?php
                                if($hours['monday-from'] === null && $hours['monday-to'] === null)
                                    echo "checked"
                             ?>
                             >
                            We are not working on Monday
                        </label>
                      </p>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.monday-from') ? 'has-error' : ''}}">
                          <label for=hoursMondayFrom>From</label>
                          <input
                            type="text"
                            id=hoursMonday name=hours[monday-from]
                            value="{{ $hours['monday-from'] }}"
                            <?php
                                if($hours['monday-from'] === null)
                                    echo "readonly"
                            ?>
                            class="form-control timepicker">
                            {!! $errors->first('hours.monday-from', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.monday-to') ? 'has-error' : ''}}">
                          <label for=hoursMondayTo>To</label>
                          <input
                            type="text" id=hoursMondayTo name=hours[monday-to]
                            value="{{ $hours['monday-to'] }}"
                            <?php
                                if($hours['monday-to'] === null)
                                    echo "readonly"
                            ?>
                            class="form-control timepicker">
                            {!! $errors->first('hours.monday-to', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.monday-from2') ? 'has-error' : ''}}">
                          <label for=hoursMondayFrom2>From</label>
                          <input
                            type="text"
                            id=hoursMondayFrom2 name=hours[monday-from2]
                            value="{{ $hours['monday-from2'] }}"
                            <?php
                                if($hours['monday-from2'] === null)
                                    echo "readonly"
                            ?>
                            class="form-control timepicker"
                            >
                            {!! $errors->first('hours.monday-from2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.monday-to2') ? 'has-error' : ''}}">
                          <label for=hoursMondayTo2>To</label>
                          <input
                            type="text"
                            id=hoursMondayTo2
                            name=hours[monday-to2]
                            class="form-control timepicker"
                            value="{{ $hours['monday-to2'] }}"
                            <?php
                                if($hours['monday-to2'] === null)
                                    echo "readonly"
                            ?>
                            >
                            {!! $errors->first('hours.monday-to2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>
                    </div>

                    <div class="row" data-hoursday=tuesday>
                      <p  align="center"><strong>Tuesday</strong></p>

                      <p class=text-center>
                        <label for="not-working-tuesday">
                          <input type="checkbox"
                            name="not-working[tuesday]"
                            value=tuesday id=not-working-tuesday
                            @change="notWorking('tuesday')"
                            <?php
                                if($hours['tuesday-from'] === null && $hours['tuesday-to'] === null)
                                    echo "checked"
                             ?>>
                            We are not working on Tuesday
                        </label>
                      </p>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.tuesday-from') ? 'has-error' : ''}}">
                          <label for=hoursTuesdayFrom>From</label>
                          <input type="text" id=hoursTuesdayFrom name=hours[tuesday-from]
                          class="form-control timepicker"
                          value="{{ $hours['tuesday-from'] }}"
                          <?php
                                if($hours['tuesday-from'] === null)
                                    echo "readonly"
                            ?>>
                          {!! $errors->first('hours.tuesday-from', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.tuesday-to') ? 'has-error' : ''}}">
                          <label for=hoursTuesdayTo>To</label>
                          <input type="text"
                          id=hoursTuesdayTo
                          name=hours[tuesday-to]
                          value="{{ $hours['tuesday-to'] }}"
                          <?php
                                if($hours['tuesday-to'] === null)
                                    echo "readonly"
                            ?>
                          class="form-control timepicker">
                          {!! $errors->first('hours.tuesday-to', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.tuesday-from2') ? 'has-error' : ''}}">
                          <label for=hoursTuesdayFrom2>From</label>
                          <input type="text"
                          id=hoursTuesdayFrom2
                          name=hours[tuesday-from2]
                          value="{{ $hours['tuesday-from2'] }}"
                          <?php
                                if($hours['tuesday-from2'] === null)
                                    echo "readonly"
                            ?>
                          class="form-control timepicker">
                          {!! $errors->first('hours.tuesday-from2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.tuesday-to2') ? 'has-error' : ''}}">
                          <label for=hoursTuesdayTo2>To</label>
                          <input type="text" id=hoursTuesdayTo2 name=hours[tuesday-to2]
                          value="{{ $hours['tuesday-to2'] }}"
                          <?php
                                if($hours['tuesday-to2'] === null)
                                    echo "readonly"
                            ?>
                          class="form-control timepicker">
                          {!! $errors->first('hours.tuesday-to2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>
                    </div>

                    <div class="row" data-hoursday=wednesday>
                      <p  align="center"><strong>Wednesday</strong></p>

                      <p class=text-center>
                        <label for="not-working-wednesday">
                          <input type="checkbox"
                            name="not-working[wednesday]"
                            value=wednesday id=not-working-wednesday
                            @change="notWorking('wednesday')"
                            <?php
                                if($hours['wednesday-from'] === null && $hours['wednesday-to'] === null)
                                    echo "checked"
                             ?>>
                            We are not working on Wednesday
                        </label>
                      </p>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.wednesday-from') ? 'has-error' : ''}}">
                          <label for=hoursWednesdayFrom>From</label>
                          <input type="text" id=hoursWednesdayFrom name=hours[wednesday-from] class="form-control timepicker"
                          value="{{ $hours['wednesday-from'] }}"
                          <?php
                                if($hours['wednesday-from'] === null)
                                    echo "readonly"
                            ?>
                          >
                          {!! $errors->first('hours.wednesday-from', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.wednesday-to') ? 'has-error' : ''}}">
                          <label for=hoursWednesdayTo>To</label>
                          <input type="text" id=hoursWednesdayTo name=hours[wednesday-to] class="form-control timepicker"
                          value="{{ $hours['wednesday-to'] }}"
                            <?php
                                if($hours['wednesday-to'] === null)
                                echo "readonly"
                            ?>
                          >
                          {!! $errors->first('hours.wednesday-to', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.wednesday-from2') ? 'has-error' : ''}}">
                          <label for=hoursWednesdayFrom2>From</label>
                          <input type="text" id=hoursWednesdayFrom2 name=hours[wednesday-from2] class="form-control timepicker"
                          value="{{ $hours['wednesday-from2'] }}"
                          <?php
                                if($hours['wednesday-from2'] === null)
                                    echo "readonly"
                            ?>>
                          {!! $errors->first('hours.wednesday-from2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.wednesday-to2') ? 'has-error' : ''}}">
                          <label for=hoursWednesdayTo2>To</label>
                          <input type="text" id=hoursWednesdayTo2 name=hours[wednesday-to2] class="form-control timepicker"
                          value="{{ $hours['wednesday-to2'] }}"
                          <?php
                                if($hours['wednesday-to2'] === null)
                                    echo "readonly"
                            ?>>
                          {!! $errors->first('hours.wednesday-to2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>
                    </div>

                    <div class="row" data-hoursday=thursday>
                      <p  align="center"><strong>Thursday</strong></p>

                      <p class=text-center>
                        <label for="not-working-thursday">
                          <input type="checkbox"
                            name="not-working[thursday]"
                            value=thursday
                            id=not-working-thursday
                            @change="notWorking('thursday')"
                            <?php
                                if($hours['thursday-from'] === null && $hours['thursday-to'] === null)
                                    echo "checked"
                             ?>>
                            We are not working on Thursday
                        </label>
                      </p>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.thursday-from') ? 'has-error' : ''}}">
                          <label for=hoursThursdayFrom>From</label>
                          <input type="text" id=hoursThursdayFrom name=hours[thursday-from] class="form-control timepicker"
                          value="{{ $hours['thursday-from'] }}"
                          <?php
                            if($hours['thursday-from'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.thursday-from', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.thursday-to') ? 'has-error' : ''}}">
                          <label for=hoursThursdayTo>To</label>
                          <input type="text"  id=hoursThursdayTo name=hours[thursday-to] class="form-control timepicker"
                          value="{{ $hours['thursday-to'] }}"
                          <?php
                            if($hours['thursday-to'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.thursday-to', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.thursday-from2') ? 'has-error' : ''}}">
                          <label for=hoursThursdayFrom2>From</label>
                          <input type="text" id=hoursThursdayFrom2 name=hours[thursday-from2] class="form-control timepicker"
                          value="{{ $hours['thursday-from2'] }}"
                          <?php
                            if($hours['thursday-from2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.thursday-from2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.thursday-to') ? 'has-error' : ''}}">
                          <label for=hoursThursdayTo2>To</label>
                          <input type="text" id=hoursThursdayTo2 name=hours[thursday-to2] class="form-control timepicker"
                          value="{{ $hours['thursday-to2'] }}"
                          <?php
                            if($hours['thursday-to2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.thursday-to2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>
                    </div>

                    <div class="row" data-hoursday=friday>
                      <p  align="center"><strong>Friday</strong></p>

                      <p class=text-center>
                        <label for="not-working-friday">
                          <input type="checkbox"
                            name="not-working[friday]"
                            value=friday
                            id=not-working-friday
                            @change="notWorking('friday')"
                            <?php
                                if($hours['friday-from'] === null && $hours['friday-to'] === null)
                                    echo "checked"
                             ?>
                          >
                            We are not working on Friday
                        </label>
                      </p>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.friday-from') ? 'has-error' : ''}}">
                          <label for=hoursFridayFrom>From</label>
                          <input type="text" id=hoursFridayFrom name=hours[friday-from] class="form-control timepicker"
                          value="{{ $hours['friday-from'] }}"
                          <?php
                            if($hours['friday-from'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.friday-from', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.friday-to') ? 'has-error' : ''}}">
                          <label for=hoursFridayTo>To</label>
                          <input type="text" id=hoursFridayTo name=hours[friday-to] class="form-control timepicker"
                          value="{{ $hours['friday-to'] }}"
                          <?php
                            if($hours['friday-to'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.friday-to', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.friday-from2') ? 'has-error' : ''}}">
                          <label for=hoursFridayFrom2>From</label>
                          <input type="text" d=hoursFridayFrom2 name=hours[friday-from2] class="form-control timepicker"
                          value="{{ $hours['friday-from2'] }}"
                          <?php
                            if($hours['friday-from2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.friday-from2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.friday-to2') ? 'has-error' : ''}}">
                          <label for=hoursFridayTo2>To</label>
                          <input type="text" id=hoursFridayTo2 name=hours[friday-to2] class="form-control timepicker"
                          value="{{ $hours['friday-to2'] }}"
                          <?php
                            if($hours['friday-to2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.friday-to2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                    </div>

                    <div class="row" data-hoursday=saturday>
                      <p  align="center"><strong>Saturday</strong></p>

                      <p class=text-center>
                        <label for="not-working-saturday">
                          <input type="checkbox"
                            name="not-working[saturday]"
                            value=saturday
                            id=not-working-saturday
                            @change="notWorking('saturday')"
                            <?php
                                if($hours['saturday-from'] === null && $hours['saturday-to'] === null)
                                    echo "checked"
                             ?>>
                            We are not working on Saturday
                        </label>
                      </p>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.saturday-from') ? 'has-error' : ''}}">
                          <label for=hoursSaturdayFrom>From</label>
                          <input type="text" id=hoursSaturdayFrom name=hours[saturday-from] class="form-control timepicker"
                          value="{{ $hours['saturday-from'] }}"
                          <?php
                            if($hours['saturday-from'] === null)
                                echo "readonly"
                          ?>
                          >
                          {!! $errors->first('hours.saturday-from', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.saturday-from') ? 'has-error' : ''}}">
                          <label for=hoursSaturdayTo>To</label>
                          <input type="text" id=hoursSaturdayTo name=hours[saturday-to] class="form-control timepicker"
                          value="{{ $hours['saturday-to'] }}"
                          <?php
                            if($hours['saturday-to'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.saturday-to', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.saturday-from') ? 'has-error' : ''}}">
                          <label for=hoursSaturdayFrom2>From</label>
                          <input type="text" id=hoursSaturdayFrom2 name=hours[saturday-from2] class="form-control timepicker"
                          value="{{ $hours['saturday-from2'] }}"
                          <?php
                            if($hours['saturday-from2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.saturday-from2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.saturday-from') ? 'has-error' : ''}}">
                          <label for=hoursSaturdayTo2>To</label>
                          <input type="text" id=hoursSaturdayTo2 name=hours[saturday-to2] class="form-control timepicker"
                          value="{{ $hours['saturday-to2'] }}"
                          <?php
                            if($hours['saturday-to2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.saturday-to2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                    </div>

                    <div class="row" data-hoursday=sunday>
                      <p  align="center"><strong>Sunday</strong></p>

                      <p class=text-center>
                        <label for="not-working-sunday">
                          <input type="checkbox"
                            name="not-working[sunday]"
                            value=sunday
                            id=not-working-sunday
                            @change="notWorking('sunday')"
                            <?php
                                if($hours['sunday-from'] === null && $hours['sunday-to'] === null)
                                    echo "checked"
                             ?>>
                            We are not working on Sunday
                        </label>
                      </p>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.sunday-from') ? 'has-error' : ''}}">
                          <label for=hoursSundayFrom>From</label>
                          <input type="text" id=hoursSundayFrom name=hours[sunday-from] class="form-control timepicker"
                          value="{{ $hours['sunday-from'] }}"
                          <?php
                            if($hours['sunday-from'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.sunday-from', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.sunday-from') ? 'has-error' : ''}}">
                          <label for=hoursSundayTo>To</label>
                          <input type="text" id=hoursSundayTo name=hours[sunday-to] class="form-control timepicker"
                          value="{{ $hours['sunday-to'] }}"
                          <?php
                            if($hours['sunday-to'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.sunday-to', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.sunday-from') ? 'has-error' : ''}}">
                          <label for=hoursSundayFrom2>From</label>
                          <input type="text" id=hoursSundayFrom2 name=hours[sunday-from2] class="form-control timepicker"
                          value="{{ $hours['sunday-from2'] }}"
                          <?php
                            if($hours['sunday-from2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.sunday-from2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('hours.sunday-from') ? 'has-error' : ''}}">
                          <label for=hoursSundayTo2>To</label>
                          <input type="text" id=hoursSundayTo2 name=hours[sunday-to2] class="form-control timepicker"
                          value="{{ $hours['sunday-to2'] }}"
                          <?php
                            if($hours['sunday-to2'] === null)
                                echo "readonly"
                          ?>>
                          {!! $errors->first('hours.sunday-to2', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                    </div>

                    <div class="form-group {{ $errors->has('special-notes') ? 'has-error' : ''}}">
                      <label for=special-notes>Special Notes</label>
                      <input type="text" id=special-notes name=special-notes class="form-control" placeholder="Special Notes" value="{{ $clinic->special-notes }}">
                    </div>

                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                      <label for="logo">Logo input</label>
                      <input type="file" id="logo" name=logo>
                    </div>

                  </div>

                  <button type="submit" class="btn btn-primary" >Create Clinic</button>
              </form>
            </div>

          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
@stop