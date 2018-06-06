@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me</title>
@stop

@section('AditionalHead')

@stop

@section('BodySetup')
	<body class="page">
	<header id="header" class="has-border">
		@include('Front.main.header')
	</header>

	<div id="wrapper">

		@include('Front.results.partials.search')

		<div class="container page-content">
			<div class="row">
				<div class="col col-100">
				</div>
			</div>
			<div id="content">
				@include('Front.results.partials.content')
			</div>
			<div id="sidebar" class="bg-main-color2">
			</div>
		</div>
	</div>

	<footer id="footer" class="bg-main-color border-main-color2">
	</footer>
@stop

@section('AditionalFoot')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&v=3.exp"></script>
<script type="text/javascript">

	function initMap() {
		var input = document.getElementById('address-input');
		var autocomplete = new google.maps.places.Autocomplete(input);
	}

     var myLatlng = new google.maps.LatLng(-33.829326,151.230331);
	 var myLatlng2 = new google.maps.LatLng(-33.7871468,151.1945336);
	 var myLatlng3 = new google.maps.LatLng(-33.823943,151.1706853);
	 var myLatlng4 = new google.maps.LatLng(-33.8153578,151.1495098);

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
			zoom: 12,
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
		overlay2 = new CustomMarker (
			myLatlng2,
			map,
			{
				marker_id: '2',
			},
		);
		overlay3 = new CustomMarker (
			myLatlng3,
			map,
			{
				marker_id: '3',
			},
		);
		overlay4 = new CustomMarker (
			myLatlng4,
			map,
			{
				marker_id: '4',
			},
		);
	}

	google.maps.event.addDomListener(window, 'load', initialize);



</script>
@stop