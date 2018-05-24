@extends('layouts.admin')

@section('content')

    <div class="col-md-6">

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

    <admin-media></admin-media>

@stop