@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me</title>
@stop

@section('AditionalHead')
<style type="text/css">
	.clinic-gallery .gallery-item {
		height: 350px;
		background-size: cover !important;
		background-position: center !important;
		background-repeat: no-repeat !important;
	}
</style>
@stop

@section('BodySetup')
	<body class="page single">
	<header id="header">
		@include('Front.main.header')
	</header>

	<div id="wrapper">
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&v=3.exp"></script>
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

</script>
@stop