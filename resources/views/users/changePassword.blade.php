@extends('layouts.admin')

@section('content')

    <section class="content-header">
        <h1>
            Change Password
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <section class="content">

        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif

        @include('users.partials._passwordForm')
    </section>
@stop