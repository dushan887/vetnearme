@extends('layouts.admin')

@section('content')
  <admin-post-form ></admin-post-form>
@stop

@section('extraJS')
  <script src="{{ asset('js/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
  <script src="{{ asset('js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
@stop