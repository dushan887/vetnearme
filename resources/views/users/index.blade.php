@extends('layouts.admin')
<php dd(333) ?>
@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ url('/admin/users/new_user') }}" class="btn btn-primary btn-block margin-bottom">Add New User</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Filters</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="filter-opt3">Show entries:</label>
                <select class="form-control" id="filter-opt3">
                  <option>10</option>
                  <option>25</option>
                  <option>50</option>
                </select>
              </div>
              <div class="form-group">
                <label for="filter-opt1">Has clinic assigned:</label>
                <select class="form-control" id="filter-opt1">
                  <option>Any</option>
                  <option>Yes</option>
                  <option>No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="filter-opt2">User role:</label>
                <select class="form-control" id="filter-opt2">
                  <option>Any</option>
                  <option>User</option>
                  <option>Admin</option>
                  <option>Super Admin</option>
                </select>
              </div>
              <div class="form-group">
                <label for="filter-opt4">User gender:</label>
                <select class="form-control" id="filter-opt4">
                  <option>Any</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
              <div class="pull-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Apply Filter</button>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User List</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search User">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/user') }}"'><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/mailbox/compose') }}"'><i class="fa fa-envelope-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive">
                <table id="user_table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <td><input type="checkbox"></td>
                      <th>User</th>
                      <th>Title</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Clinic</th>
                      <th>Role</th>
                      <th>Gender</th>
                      <th width="150">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="User Image" width="30" height="30"></td>
                      <td>Title</td>
                      <td>First Name</td>
                      <td>Last Name</td>
                      <td>Clinic Name
                      </td>
                      <td>Super Admin</td>
                      <td>Male</td>
                      <td width="150">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/user') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/users/edit_user') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/mailbox/compose') }}"'><i class="fa fa-envelope-o"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="User Image" width="30" height="30"></td>
                      <td>Title</td>
                      <td>First Name</td>
                      <td>Last Name</td>
                      <td>Clinic Name
                      </td>
                      <td>Super Admin</td>
                      <td>Male</td>
                      <td width="150">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/user') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/users/edit_user') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/mailbox/compose') }}"'><i class="fa fa-envelope-o"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="User Image" width="30" height="30"></td>
                      <td>Title</td>
                      <td>First Name</td>
                      <td>Last Name</td>
                      <td>Clinic Name
                      </td>
                      <td>Super Admin</td>
                      <td>Male</td>
                      <td width="150">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/user') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/users/edit_user') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/mailbox/compose') }}"'><i class="fa fa-envelope-o"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="User Image" width="30" height="30"></td>
                      <td>Title</td>
                      <td>First Name</td>
                      <td>Last Name</td>
                      <td>Clinic Name
                      </td>
                      <td>Super Admin</td>
                      <td>Male</td>
                      <td width="150">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/user') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/users/edit_user') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/mailbox/compose') }}"'><i class="fa fa-envelope-o"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="User Image" width="30" height="30"></td>
                      <td>Title</td>
                      <td>First Name</td>
                      <td>Last Name</td>
                      <td>Clinic Name
                      </td>
                      <td>Super Admin</td>
                      <td>Male</td>
                      <td width="150">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/user') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/users/edit_user') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/mailbox/compose') }}"'><i class="fa fa-envelope-o"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><input type="checkbox"></td>
                      <th>User</th>
                      <th>Title</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Clinic</th>
                      <th>Role</th>
                      <th>Gender</th>
                      <th width="150">Action</th>
                    </tr>
                  </tfoot>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->



@stop