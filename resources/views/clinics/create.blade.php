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
              <h3 class="box-title">New Clinic</h3>
            </div>

            <div class="box-body">
              <form class="form-horizontal"
                action="/admin/clinics/store"
                method=post
                role=form
              >
              @csrf

                  <div class="col-md-12">

                    <div class="form-group">
                      <label for=name>Clinic Name</label>
                      <input type="text" id=name name=name class="form-control" placeholder="Clinic Name">
                    </div>

                    <div class="form-group">
                      <label for=description>Description</label>
                      <textarea class="form-control" id=description name=description placeholder="Description"></textarea>
                    </div>

                    <div class="form-group">
                      <label for=email>Email Address</label>
                      <input type="email" id=email name=email class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group">
                      <label name=phoneNumber>Phone Number</label>
                      <input type="text" id=phoneNumber name=phoneNumber class="form-control" placeholder="Phone Number">
                    </div>

                    <div class="form-group">
                      <label for=emergencyNumber>Emergency Number</label>
                      <input type="text" id=emergencyNumber name=emergencyNumber class="form-control" placeholder="Emergency Number">
                    </div>

                    <div class="form-group">
                      <label for=url>Web URL</label>
                      <input type="text" id=url name=url class="form-control" placeholder="Web URL">
                    </div>

                    <hr>

                    <div class="form-group">
                      <label for=city>City</label>
                      <input type="text" id=city name=city class="form-control" placeholder="City">
                    </div>

                    <div class="form-group">
                      <label for=address>Address</label>
                      <input type="text" id=address name=address class="form-control" placeholder="Address">
                    </div>

                    <div class="form-group">
                      <label for=zip>Postal Code</label>
                      <input type="text" id=zip name=zip class="form-control" placeholder="Postal Code">
                    </div>

                    <div class="form-group">
                      <label for=country>Country</label>
                      <input type="text" id=country name=country class="form-control" placeholder="Country">
                    </div>

                    <div class="form-group">
                      <label for=gmap>Google Map URL</label>
                      <input type="text" id=gmap id=gmap class="form-control" placeholder="Google Map URL">
                    </div>

                    <hr>

                    <div class="form-group">
                      <label for=socialFacebook>Facebook</label>
                      <input type="text" id=socialFacebook name=social[facebook] class="form-control" placeholder="Facebook">
                    </div>

                    <div class="form-group">
                      <label for=socialTwitter>Twitter</label>
                      <input type="text" id=socialTwitter name=social[twitter] class="form-control" placeholder="Twitter">
                    </div>

                    <div class="form-group">
                      <label for=socialInstagram>Instagram</label>
                      <input type="text" id=socialInstagram name=social[instagram] class="form-control" placeholder="Instagram">
                    </div>

                    <div class="form-group">
                      <label for=socialLinkedin>Linkedin</label>
                      <input type="text" id=socialLinkedin name=social[linkedin] class="form-control" placeholder="Linkedin">
                    </div>

                    <div class="form-group">
                      <label for=socialYoutube>YouTube</label>
                      <input type="text" id=socialYoutube name=social[youtube] class="form-control" placeholder="YouTube">
                    </div>

                    <hr>

                    <div class="row">
                      <p  align="center"><strong>Monday</strong></p>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursMondayFrom>From</label>
                          <input type="time" id=hoursMonday name=hours[monday-from] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursMondayTo>To</label>
                          <input type="time" id=hoursMondayTo name=hours[monday-to] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursMondayFrom2>From</label>
                          <input type="time" id=hoursMondayFrom2 name=hours[monday-from2]  class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursMondayTo2>To</label>
                          <input type="time" id=hoursMondayTo2 name=hours[monday-to2] class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <p  align="center"><strong>Tuesday</strong></p>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursTuesdayFrom>From</label>
                          <input type="time" id=hoursTuesdayFrom name=hours[tuesday-from] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursTuesdayTo>To</label>
                          <input type="time" id=hoursTuesdayTo name=hours[tuesday-to] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursTuesdayFrom2>From</label>
                          <input type="time" id=hoursTuesdayFrom2  name=hours[tuesday-from2] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursTuesdayTo2>To</label>
                          <input type="time" id=hoursTuesdayTo2 name=hours[tuesday-to2] class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <p  align="center"><strong>Wednesday</strong></p>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursWednesdayFrom>From</label>
                          <input type="time" id=hoursWednesdayFrom name=hours[wednesday-from] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursWednesdayTo>To</label>
                          <input type="time" id=hoursWednesdayTo name=hours[wednesday-to] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursWednesdayFrom2>From</label>
                          <input type="time" id=hoursWednesdayFrom2 name=hours[wednesday-from2] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursWednesdayTo2>To</label>
                          <input type="time" id=hoursWednesdayTo2 name=hours[wednesday-to2] class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <p  align="center"><strong>Thursday</strong></p>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursThursdayFrom>From</label>
                          <input type="time" id=hoursThursdayFrom name=hours[thursday-from] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursThursdayTo>To</label>
                          <input type="time"  id=hoursThursdayTo name=hours[thursday-to] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursThursdayFrom2>From</label>
                          <input type="time" id=hoursThursdayFrom2 name=hours[thursday-from2] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursThursdayTo2>To</label>
                          <input type="time" id=hoursThursdayTo2 name=hours[thursday-to2] class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <p  align="center"><strong>Friday</strong></p>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursFridayFrom>From</label>
                          <input type="time" id=hoursFridayFrom name=hours[friday-from] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursFridayTo>To</label>
                          <input type="time" id=hoursFridayTo name=hours[friday-to] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursFridayFrom2>From</label>
                          <input type="time" d=hoursFridayFrom2 name=hours[friday-from2] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursFridayTo2>To</label>
                          <input type="time" id=hoursFridayTo2 name=hours[friday-to2] class="form-control" value="00:00">
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <p  align="center"><strong>Saturday</strong></p>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSaturdayFrom>From</label>
                          <input type="time" id=hoursSaturdayFrom name=hours[saturday-from] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSaturdayTo>To</label>
                          <input type="time" id=hoursSaturdayTo name=hours[saturday-to] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSaturdayFrom2>From</label>
                          <input type="time" id=hoursSaturdayFrom2 name=hours[saturday-from2] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSaturdayTo2>To</label>
                          <input type="time" id=hoursSaturdayTo2 name=hours[saturday-to2] class="form-control" value="00:00">
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <p  align="center"><strong>Sunday</strong></p>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSundayFrom>From</label>
                          <input type="time" id=hoursSundayFrom name=hours[sunday-from] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSundayTo>To</label>
                          <input type="time" id=hoursSundayTo name=hours[sunday-to] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSundayFrom2>From</label>
                          <input type="time" id=hoursSundayFrom2 name=hours[sunday-from2] class="form-control" value="00:00">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for=hoursSundayTo2>To</label>
                          <input type="time" id=hoursSundayTo2 name=hours[sunday-to2] class="form-control" value="00:00">
                        </div>
                      </div>

                    </div>

                    <div class="form-group">
                      <label>Special Notes</label>
                      <input type="text" class="form-control" placeholder="Special Notes">
                    </div>

                    <div class="form-group">
                      <label for="logo">Logo input</label>
                      <input type="file" id="logo" name=logo>
                    </div>

                  </div>
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