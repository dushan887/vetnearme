@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Post
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Blog</a></li>
        <li class="active">New Post</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Post</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <input class="form-control" placeholder="Title">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="permalink">
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px">
                      
                    </textarea>
              </div>
             
            </div>
            <!-- /.box-body -->
            
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Status</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">              
              <a href="" class="btn btn-success btn-block">Publish</a>
              <a href="" class="btn btn-primary btn-block">Draft</a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Categories</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
              </div>
              <div class="form-group">
                <div class="col-xs-9 no-padding">
                  <input type="text" class="form-control" placeholder="Enter New Categorie">
                </div>
                <div class="col-xs-3 no-padding">
                  <button type="button" class="btn btn-square btn-block btn-primary" data-widget="collapse" style="border-top-left-radius: 0; border-bottom-left-radius: 0;"><i class="fa fa-plus"></i>
                </button>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Cover Image</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">              
              <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

           <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Expert</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Enter ..." ></textarea>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    
  
@stop