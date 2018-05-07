@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Posts
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Posts</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ url('/admin/blog/create') }}" class="btn btn-primary btn-block margin-bottom">New Post</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="mailbox.html"><i class="fa fa-file"></i> Posts</a></li>
                <li><a href="#"><i class="fa fa-file-o"></i> Draft</a></li>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
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
                <label for="filter-opt1">Author</label>
                <select class="form-control" id="filter-opt1">
                  <option>Any</option>
                  <option>Name Surname</option>
                  <option>Name Surname</option>
                  <option>Name Surname</option>
                  <option>Name Surname</option>
                </select>
              </div>
              <div class="form-group">
                <label for="filter-opt1">Status</label>
                <select class="form-control" id="filter-opt1">
                  <option>Any</option>
                  <option>Published</option>
                  <option>Draft</option>
                </select>
              </div>
              <div class="form-group">
                <label for="filter-opt1">Date</label>
                <select class="form-control" id="filter-opt1">
                  <option>Any</option>
                  <option>April, 2018</option>
                  <option>May, 2018</option>
                </select>
              </div>
              <div class="pull-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Apply Filter</button>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Post List</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Posts">
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
                  <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive">
                <table id="practice_table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <th>Img</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Published Date</th>
                      <th>Status</th>
                      <th width="115">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="Practice Image" width="30" height="30"></td>
                      <td>Post Title</td>
                      <td>Name Surname</td>
                      <td>18. April, 2018</td>
                      <td>Published</td>
                      <td width="115">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog/create') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="Practice Image" width="30" height="30"></td>
                      <td>Post Title</td>
                      <td>Name Surname</td>
                      <td>18. April, 2018</td>
                      <td>Published</td>
                      <td width="115">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog/create') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="Practice Image" width="30" height="30"></td>
                      <td>Post Title</td>
                      <td>Name Surname</td>
                      <td>18. April, 2018</td>
                      <td>Published</td>
                      <td width="115">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog/create') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="Practice Image" width="30" height="30"></td>
                      <td>Post Title</td>
                      <td>Name Surname</td>
                      <td>18. April, 2018</td>
                      <td>Published</td>
                      <td width="115">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog/create') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="Practice Image" width="30" height="30"></td>
                      <td>Post Title</td>
                      <td>Name Surname</td>
                      <td>18. April, 2018</td>
                      <td>Published</td>
                      <td width="115">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog/create') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="Practice Image" width="30" height="30"></td>
                      <td>Post Title</td>
                      <td>Name Surname</td>
                      <td>18. April, 2018</td>
                      <td>Published</td>
                      <td width="115">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog/create') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <td width="47"><img src="http://via.placeholder.com/160x160" alt="Practice Image" width="30" height="30"></td>
                      <td>Post Title</td>
                      <td>Name Surname</td>
                      <td>18. April, 2018</td>
                      <td>Published</td>
                      <td width="115">
                        <div class="btn-group pull-right">
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog') }}"'><i class="fa fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm" onclick='window.location.href= "{{ url('/admin/blog/create') }}"'><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td width="35"><input type="checkbox"></td>
                      <th>Img</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Published Date</th>
                      <th>Status</th>
                      <th width="115">Action</th>
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