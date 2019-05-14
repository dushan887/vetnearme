@extends('Front.main.main-template')

@section('SEOinfo')
	<title>{{ $clinic->name }}, {{ $clinic->city }}, {{ $clinic->zip }} - Vet Near Me</title>

	<meta name="description" content="{{ $clinic->meta_description }}">
	<meta name="keywords" content="{{ $clinic->keywords }}">
	<meta name="author" content="Vet Near Me">

	<meta property="og:title" content="{{ $clinic->name }}, {{ $clinic->city }}, {{ $clinic->zip }} - Vet Near Me">
	<meta property="og:description" content="{{ $clinic->meta_description }}">
	<meta property="og:image" content="{{ url($metaImage) }}">
	<meta property="og:url" content="{{ $clinic->url }}">

	<meta name="twitter:title" content="{{ $clinic->name }}, {{ $clinic->city }}, {{ $clinic->zip }} - Vet Near Me ">
	<meta name="twitter:description" content="{{ $clinic->meta_description }}">
	<meta name="twitter:image" content="{{ url($metaImage) }}">
	<meta name="twitter:card" content="summary_large_image">
@stop

@section('AditionalHead')
<style type="text/css">
	.clinic-gallery .gallery-item {
		height: 350px;
		background-size: cover !important;
		background-position: center !important;
		background-repeat: no-repeat !important;
	}
	#address-input {
		width: 100%;
	    height: 40px;
	    line-height: 40px;
	    padding: 0 10px;
	    padding-left: 30px;
	    border: 1px solid #468a97;
	    box-shadow: none;
	    margin: 15px auto;
	    border-radius: 5px;
	}
	#loc-btn {
	    position: absolute;
	    top: 9px;
	    left: -5px;
	    width: 40px;
	    height: 40px;
	    padding: 13px 10px;
	    z-index: 9999999;
	    display: block;
	    cursor: pointer;
	    opacity: 0.5;
	}
	.location-search:after {
		content: '';
		position: absolute;
		display: block;
	    top: 55px;
    	left: 15px;
	    width: 200px;
	    height: 34px;
	    background: url("/img/home-arrow.png");
	    background-size: contain;
	    background-repeat: no-repeat;
	    background-position: left top;
	}
	#ds-loc {
		display: block;
	    width: 100%;
	    margin-top: 30px;
	    text-align: center;
	    border: 1px solid;
	    padding: 7px 10px;
	    border-radius: 5px;
	}
	#disable-loc {
		position: relative;
	}
	#disable-loc:before {
		content: '';
		width: 100%;
		z-index: 9999;
		height: 100%;
		display: none;
		background: rgba(255,255,255,.5);
		top: 0;
		left: 0;
		position: absolute;
	}
	#disable-loc.disable:before {
		display: block;
	}
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
		.wrapper .clinic-name h1 {
			font-size: 24px !important;
			padding: 45px 15px 0 15px;
    		text-align: center;

		}
		.clinic-header .rasault-rating {
		    left: 15px;
		    margin: auto;
		    text-align: center;
		}
		.service-list li {
			min-width: 48%
		}
	}
</style>
@stop

@section('BodySetup')
	<body class="page single">
	<header id="header">
		@include('Front.main.header')
	</header>

	<div id="wrapper">
		<div id="latitudeAndLongitude" style="visibility: hidden; opacity: 0; position: absolute;"></div>
		<div class="container page-content">
			<div class="row">
				<div class="col col-100">
				</div>
			</div>
			<div id="content">
				@include('Front.clinic.partials.content')
			</div>
			<div id="sidebar" class="bg-main-color2">
			</div>
		</div>
	</div>

	<footer id="footer" class="bg-main-color border-main-color2">
		@include('Front.main.footer')
	</footer>
@stop

@section('AditionalFoot')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&libraries=places&callback=initMap&v=3.exp"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$('.opening-hours li span').each(function() {
			if($(this).is(':contains("Closed")')) {
			      $(this).text('Closed')
			}
		})
		$('#clinicSliderCarousel .carousel-item:first-child').addClass('active');
		var url = $('#web-url-check span').text().replace('http://', '').replace('https://', '').replace('www.', '')
		var newUrl = 'www.' + url.slice(0, url.indexOf("/"))

		$('#web-url-check span').text(newUrl)
	})

		let clinic = $('#clinic')

		let myLatlng = new google.maps.LatLng(clinic.data('lat'), clinic.data('lng'));

      function CustomMarker(latlng, map, args) {
			this.latlng = latlng;
			this.args = args;
			this.setMap(map);
		}

		CustomMarker.prototype = new google.maps.OverlayView();

		CustomMarker.prototype.draw = function() {

			var self = this;

			var div = this.div;

			if (!div) {

				div = this.div = document.createElement('div');

				div.className = 'marker';

				if (typeof(self.args.marker_id) !== 'undefined') {
					div.dataset.marker_id = self.args.marker_id;
				}

				google.maps.event.addDomListener(div, "click", function(event) {
					// alert('You clicked on a custom marker!');
					google.maps.event.trigger(self, "click");
				});

				var panes = this.getPanes();
				panes.overlayImage.appendChild(div);
			}

			var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

			if (point) {
				div.style.left = (point.x - 15) + 'px';
				div.style.top = (point.y - 15) + 'px';
			}
		};

		CustomMarker.prototype.remove = function() {
			if (this.div) {
				this.div.parentNode.removeChild(this.div);
				this.div = null;
			}
		};

		CustomMarker.prototype.getPosition = function() {
			return this.latlng;
		};

      function initialize() {


		var mapOptions = {
			zoom: 15,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
	        zoomControl: true,
	        disableDefaultUI: true,
	        zoomControlOptions: {
	            style: google.maps.ZoomControlStyle.DEFAULT,
	        },
	        disableDoubleClickZoom: true,
	        mapTypeControl: false,
	        mapTypeControlOptions: {
	            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
	        },
	        scaleControl: true,
	        scrollwheel: false,
	        streetViewControl: false,
	        draggable : true,
	        overviewMapControl: false,
			}

		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

		overlay = new CustomMarker (
			myLatlng,
			map,
			{
				marker_id: '1',
			},
		);

	}

	google.maps.event.addDomListener(window, 'load', initialize);

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

	                var arrAddress = results[0].formatted_address;
					$('#address-input').val(arrAddress)
	             }
	          }); //geocoder.geocode()
	        }
	      } //showPosition
	}
$(document).ready(function() {


	    function initMap() {
			var map = new google.maps.Map(document.getElementById('map2'), {});
			var options = {
			  types: ["(regions)"],
			  componentRestrictions: {country: ["AU"]}
			 };
			var input = document.getElementById('address-input');
			var autocomplete = new google.maps.places.Autocomplete(input,options);
		}
		initMap();
		$('#loc-btn').on('click', function() {
			getMyLocation ();
			$('#disable-loc').addClass('disable');
			setTimeout(function(){
			  $('#disable-loc').removeClass('disable');
			}, 2000);
		})
		$('#ds-loc').on('click', function(e) {
			e.preventDefault();
			if ($('#address-input').val() != '') {
				var arrAddress = $('#address-input').val()
				var getDestination = $('#ds-loc').attr('ds-loc')
				$('#ds-loc').attr('href', 'https://www.google.com/maps/dir/'+arrAddress+'/'+getDestination);
				var newLink = $('#ds-loc').attr('href');
				window.open(
				  newLink,
				  '_blank' // <- This is what makes it open in a new window.
				);
			} else {
				alert( "Please input correct location!" );
			}
		})
})

</script>
@stop