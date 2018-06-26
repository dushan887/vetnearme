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

		<div class="container page-content container-1400">
			<div class="row">
				<div class="col-12">
					<h2 class="main-color"><i class="fa fa-paper-plane"></i> Pet News &amp; Advice</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-8">
					<div id="content">
						@include('Front.home.partials.content')
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div id="sidebar" class="bg-main-color2">
						@include('Front.home.partials.sidebar')
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
<div id="map" style="visibility: hidden; width: 0; height: 0; opacity: 0;position: absolute;"></div> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&libraries=places&callback=initMap"
        async defer></script>
<script>
function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {});
	var options = {
	  types: ["(regions)"],
	  componentRestrictions: {country: ["AU", "NZ"]}
	 };
	var input = document.getElementById('address-input');
	var autocomplete = new google.maps.places.Autocomplete(input,options); 
}
</script>
@stop