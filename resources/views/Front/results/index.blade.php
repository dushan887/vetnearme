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
				<div
					id="content"
					data-coordinates="{{ $coordinates }}"
					data-usercoordinates="{{ $userCoordinates }}">
					@include('Front.results.partials.content')
				</div>
				<div id="sidebar" class="bg-main-color2">
				</div>
			</div>
		</div>

		<footer id="footer" class="bg-main-color border-main-color2"></footer>
	</body>
@stop

@section('AditionalFoot')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&v=3.exp"></script>
<script type="text/javascript">

	function initMap() {
		let input        = document.getElementById('address-input');
		let autocomplete = new google.maps.places.Autocomplete(input);
	}

	let markers     	= []
	let content     	= $('#content')
	let coordinates 	= content.data('coordinates')
	let userCoordinates = content.data('usercoordinates')

	let myLatlng = new google.maps.LatLng(userCoordinates.lat,userCoordinates.lng)

	function CustomMarker(latlng, map, args) {
		this.latlng = latlng;
		this.args   = args;
		this.setMap(map);
	}

	CustomMarker.prototype = new google.maps.OverlayView();

	CustomMarker.prototype.draw = function() {

		let self = this;

		let div = this.div;

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

			let panes = this.getPanes();
			panes.overlayImage.appendChild(div);
		}

		let point = this.getProjection().fromLatLngToDivPixel(this.latlng);

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

		let mapOptions = {
			zoom: 11,
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

		let map = new google.maps.Map(document.getElementById('map'), mapOptions)

		let count = 1;

		for(coordinate in coordinates){

			let marker = new CustomMarker (
				new google.maps.LatLng(coordinates[coordinate].lat ,coordinates[coordinate].lng),
				map,
				{
					marker_id: count,
				},
			);
			count ++

			markers.push(marker)
		}

	}

	google.maps.event.addDomListener(window, 'load', initialize);

</script>
@stop