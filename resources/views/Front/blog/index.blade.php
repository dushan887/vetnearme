@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me</title>
@stop

@section('AditionalHead')
@stop

@section('BodySetup')
	<body class="page">
	<header id="header">
		@include('Front.main.header')
	</header>

	<div id="wrapper">

		@include('Front.blog.partials.banner')

		<div class="container page-content">
			<div class="row">
				<div class="col-12">
					<div id="content">
						@include('Front.blog.partials.content')
					</div>
				</div>
			{{-- 	<div class="col-12 col-md-4">
					<div id="sidebar" class="bg-main-color2"></div>
				</div> --}}
			</div>
		</div>
	</div>

	<footer id="footer" class="bg-main-color border-main-color2">
	</footer>
@stop

@section('AditionalFoot')
@stop