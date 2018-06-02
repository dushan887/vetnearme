@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Media
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Media</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Upload Files</h3>
                </div>

                @if ($errors)
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="/admin/media/store"
                    id="media-upload"
                    method=post
                    enctype="multipart/form-data"
                    role="form">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="files">File input</label>
                            <input id="files" name=files[] type="file" multiple>
                        </div>
                    </div>

                </form>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" form=media-upload>Upload Files</button>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="row">
                 <admin-media></admin-media>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>


@stop