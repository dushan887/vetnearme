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
              <form class="form-horizontal">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Clinic Name</label>
                      <input type="text" class="form-control" placeholder="Clinic Name">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="text" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                      <label>Emergency Number</label>
                      <input type="text" class="form-control" placeholder="Emergency Number">
                    </div>
                    <div class="form-group">
                      <label>Web URL</label>
                      <input type="text" class="form-control" placeholder="Web URL">
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City">
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group">
                      <label>Postal Code</label>
                      <input type="text" class="form-control" placeholder="Postal Code">
                    </div>
                    <div class="form-group">
                      <label>Country</label>
                      <input type="text" class="form-control" placeholder="Country">
                    </div>
                    <div class="form-group">
                      <label>Latitude</label>
                      <input type="text" class="form-control" placeholder="Latitude">
                    </div>
                    <div class="form-group">
                      <label>Longitude</label>
                      <input type="text" class="form-control" placeholder="Longitude">
                    </div>
                    <div class="form-group">
                      <label>Google Map URL</label>
                      <input type="text" class="form-control" placeholder="Google Map URL">
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Facebook</label>
                      <input type="text" class="form-control" placeholder="Facebook">
                    </div>
                    <div class="form-group">
                      <label>Twitter</label>
                      <input type="text" class="form-control" placeholder="Twitter">
                    </div>
                    <div class="form-group">
                      <label>Instagram</label>
                      <input type="text" class="form-control" placeholder="Instagram">
                    </div>
                    <div class="form-group">
                      <label>Linkedin</label>
                      <input type="text" class="form-control" placeholder="Linkedin">
                    </div>
                    <div class="form-group">
                      <label>YouTube</label>
                      <input type="text" class="form-control" placeholder="YouTube">
                    </div>
                    <hr>

                    <div class="row">
                      <div  align="center"><strong>Monday</strong></div>
                      <br>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div  align="center"><strong>Tuesday</strong></div>
                      <br>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div  align="center"><strong>Wednesday</strong></div>
                      <br>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div  align="center"><strong>Thursday</strong></div>
                      <br>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div  align="center"><strong>Friday</strong></div>
                      <br>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>                      
                    </div>

                    <div class="row">
                      <div  align="center"><strong>Saturday</strong></div>
                      <br>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>                      
                    </div>

                    <div class="row">
                      <div  align="center"><strong>Sunday</strong></div>
                      <br>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>From</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>To</label>
                          <input type="time" class="form-control" value="00:00">
                        </div>
                      </div>                      
                    </div>

                    <div class="form-group">
                      <label>Special Notes</label>
                      <input type="text" class="form-control" placeholder="Special Notes">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputFile">Logo input</label>
                      <input type="file" id="exampleInputFile">

                      {{-- <p class="help-block">Example block-level help text here.</p> --}}
                      
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