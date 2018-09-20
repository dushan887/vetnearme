@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me</title>
@stop

@section('AditionalHead')
<style type="text/css">
	.home-blog article header .cover-img {
	    height: calc( ( 1400px / 18) * 2 );
	}
	.advanced-search-container {
	  background-color: rgba(255,255,255,.5);
	  font-weight: bold
	}
	.button-container .checked {
	    background: rgba(255,255,255,.7);
	    border-width: 2px
	}
	@media screen and (min-width: 1200px) {
		.container-1200 {
		    max-width: 1370px;
		}
	}

</style>
@stop

@section('BodySetup')
	<body class="home">
	<header id="header">
		@include('Front.main.header')
	</header>

	<div id="wrapper">

		@include('Front.home.partials.banner')

		<div class="container page-content container-1200">
			<div class="row">
				<div class="col-12">
					<h2 class="main-color"><i class="fa fa-paper-plane"></i> Pet News &amp; Advice</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-8 col-lg-9">
					<div id="content">
						@include('Front.home.partials.content')
					</div>
				</div>
				<div class="col-12 col-md-4 col-lg-3">
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


    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      }, function() {
        console.log(setCenter(pos))
      });
    } else {
      console.log("Browser doesn't support Geolocation")
    }
}
$(document).ready(function() {
	initMap();
	console.log('da')
})
</script>
@stop