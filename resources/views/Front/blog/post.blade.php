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
			</div>
		</div>
	</div>

	<footer id="footer" class="bg-main-color border-main-color2">
		@include('Front.main.footer')
	</footer>
@stop

@section('AditionalFoot')
@stop