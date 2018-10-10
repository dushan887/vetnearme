@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me | Blog | {{ $post->title }}</title>
@stop

@section('AditionalHead')
<style type="text/css">
	@media screen and (max-width: 992px) {
		.page-content,
		.page-content .container {
			padding-left: 0 !important;
			padding-right: 0 !important;
		}
		.inner-sections > div {
		    padding-left: 15px !important;
		    padding-right: 15px !important;
		}
	}
</style>
@stop

@section('BodySetup')
	<body class="page post">
	<header id="header">
		@include('Front.main.header')
	</header>

	<div id="wrapper">

		@include('Front.blog.partials.banner')

		<div class="container page-content">
			<div class="row">
				<div class="col-12">
					<div id="content">
						@include('Front.blog.partials.single')
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