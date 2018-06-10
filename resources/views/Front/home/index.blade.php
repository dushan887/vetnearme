@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me</title>
@stop

@section('AditionalHead')

@stop

@section('BodySetup')
	<body class="home">
	<header id="header">
		@include('Front.main.header')
	</header>

	<div id="wrapper">

		@include('Front.home.partials.banner')

		<div class="container page-content">
			<div class="row">
				<div class="col col-100">
				</div>
			</div>
			<div id="content">
			</div>
				<div id="sidebar" class="bg-main-color2">
			</div>
		</div>
	</div>

	<footer id="footer" class="bg-main-color border-main-color2">
	</footer>
@stop

@section('AditionalFoot')

@stop