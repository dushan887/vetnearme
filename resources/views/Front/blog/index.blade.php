@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me</title>
@stop

@section('AditionalHead')
<style type="text/css">
	article {
		height: calc(100% - 30px);
		padding-bottom: 55px;
	}
	article footer{
		position: absolute;
		bottom: 0;
		left: 15px;
		right: 15px;
	}
</style>
@stop

@section('BodySetup')
	<body class="page post">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB8N57T"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
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
