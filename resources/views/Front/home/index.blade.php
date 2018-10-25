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
	section:not(.page-search) #search .location-search:before, .page-search #search .field.submit-search > .search-btn-icon:before,
	.search-category.raido-checkbox.radio {
		display: none;
	}
	#loc-btn {
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 50px;
	    height: 60px;
	    padding: 13px 10px;
	    z-index: 9999999;
	    display: block;
	    cursor: pointer;
	    opacity: 0.5
	}
	.home #search .field.location-search:after {
		content: '';
		position: absolute;
		display: block !important;
	    top: 55px;
    	left: 15px;
	    width: 281px;
	    height: 34px;
	    background: url("/img/home-arrow.png");
	    background-size: contain;
	    background-repeat: no-repeat;
	    background-position: center;
	}
	@media screen and (min-width: 1200px) {
		.container-1200 {
		    max-width: 1370px;
		}
	}
	@media screen and (max-width: 768px) {
		h1 {
			display: none;
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
		<div id="latitudeAndLongitude" style="visibility: hidden; opacity: 0; position: absolute;"></div>

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
}

function getMyLocation () {
  var latitudeAndLongitude=document.getElementById("latitudeAndLongitude"),
      location={
          latitude:'',
          longitude:''
      };

      if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
      }
      else{
        latitudeAndLongitude.innerHTML="Geolocation is not supported by this browser.";
      }

      function showPosition(position){
          location.latitude=position.coords.latitude;
          location.longitude=position.coords.longitude;
          latitudeAndLongitude.innerHTML=position.coords.latitude +
          "," + position.coords.longitude;
          var geocoder = new google.maps.Geocoder();
          var latLng = new google.maps.LatLng(location.latitude, location.longitude);

       if (geocoder) {
          geocoder.geocode({ 'latLng': latLng}, function (results, status) {
             if (status == google.maps.GeocoderStatus.OK) {
               
                var arrAddress = results[0].address_components;
				var itemLocality='';
				var itemCountry='';
				var itemPc='';

				// iterate through address_component array
				$.each(arrAddress, function (i, address_component) {
				    console.log('address_component:'+i);

				    if (address_component.types[0] == "locality"){
				        // console.log("town:"+address_component.long_name);
				        itemLocality = address_component.long_name;
				    }

				    if (address_component.types[0] == "country"){ 
				        // console.log("country:"+address_component.long_name); 
				        itemCountry = address_component.long_name;
				    }

				    if (address_component.types[0] == "postal_code"){ 
				        // console.log("pc:"+address_component.long_name);  
				        itemPc = address_component.long_name;
				    }
				    //return false; // break the loop   
				});

				$('#address-input').val(itemLocality +' '+ itemPc+' '+itemCountry);
             }
          }); //geocoder.geocode()
        }
      } //showPosition
}
$(document).ready(function() {
	$('.field.location-search').append('<div id="loc-btn"><img src="/img/gps-fixed-indicator.png"></div>');
	$(document).on("click", "#loc-btn", function(){
	    getMyLocation();
	});
	if ($(window).width() < 992) {
		$('form').find("input[type=text]").each(function(ev)
		  {
		      if(!$(this).val()) { 
			     $(this).attr("placeholder", "Enter suburb, town or city");
			  }
		 })
	}
	
})
</script>
@stop