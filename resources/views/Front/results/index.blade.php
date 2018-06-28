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
				<div
					id="content"
					data-coordinates="{{ $coordinates }}"
					data-usercoordinates="{{ $userCoordinates }}"
					data-urls="">
					@include('Front.results.partials.content')
				</div>
				<div id="sidebar" class="bg-main-color2">
				</div>
			</div>
		</div>

		<footer id="footer" class="bg-main-color border-main-color2">
			@include('Front.main.footer')
		</footer>
	</body>
@stop

@section('AditionalFoot')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&libraries=places"></script>
<script type="text/javascript">


	function initMap() {
		let options = {
		  types: ["(regions)"],
		  componentRestrictions: {country: ["AU", "NZ"]}
		 };
		let input        = document.getElementById('address-input');
		let autocomplete = new google.maps.places.Autocomplete(input,options);
	}

	function setZoom() {

		let zoom = 14;

		switch(parseInt($('#radius').val(), 10)){
			case 2:
				zoom = 14;
			break;

			case 5:
				zoom = 13;
			break;

			case 10:
				zoom = 12;
			break;

			case 25:
				zoom = 11;
			break;

			case 50:
				zoom = 10;
			break;

			case 100:
				zoom = 9;
			break;

			case 200:
				zoom = 8;
			break;

			case 500:
				zoom = 7;
			break;

			default:
				zoom = 14;
		}

		return zoom;
	}

	let markers     	= []
	let content     	= $('#content')
	let coordinates 	= content.data('coordinates')
	let userCoordinates = content.data('usercoordinates')
	let urls            = content.data('urls').split(',')

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
				div.dataset.marker_pin = self.args.marker_pin;
			}

			google.maps.event.addDomListener(div, "click", function(event) {
				// alert('You clicked on a custom marker!');
				google.maps.event.trigger(self, "click");
					var infoIndex = $(this).attr('data-marker_id')
					if (infoIndex != 'start') {
						if (!$(this).hasClass('open')) {
							var infoTitle = $('#visual-resaults .inner > ul li:eq('+infoIndex+') .resault-title').html();
							var infoAddress = '<i class="fas fa-map-marker-alt"></i>' + $('#visual-resaults .inner > ul li:eq('+infoIndex+') .resault-address').html();
							var infoEmail = $('#visual-resaults .inner > ul li:eq('+infoIndex+') .resault-email').html();
							var infoPhone = $('#visual-resaults .inner > ul li:eq('+infoIndex+') .resault-phone').html();
							var infoWeb = $('#visual-resaults .inner > ul li:eq('+infoIndex+') .resault-web').html();
							$('.marker').removeClass('open')
							$(this).addClass('open').append('<div class="info-window">'+
								'<div class="info-title"><strong> '+ infoTitle + '</div>' +
								'<div class="info-address"> '+ infoAddress + '</div>' +
								'<div class="info-email"> '+ infoEmail + '</div>' +
								'<div class="info-phone"> '+ infoPhone + '</div>' +
								'<div class="info-web"> '+ infoWeb + '</div>' +
								'</div>')
						} else {
							if ($(event.target).hasClass('marker')) {
								$('.marker').removeClass('open')
							}
						};

					}
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
			zoom: setZoom(),
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoomControl: true,
			disableDefaultUI: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.DEFAULT,
			},
			disableDoubleClickZoom: true,
			mapTypeControl: false,
			clickableIcons: false,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			},
			scaleControl: false,
			scrollwheel: false,
			streetViewControl: false,
			draggable : true,
			overviewMapControl: false,
			}

		let map    = new google.maps.Map(document.getElementById('map'), mapOptions)
		let bounds = new google.maps.LatLngBounds()

		let count = 0;
		let marker = new CustomMarker (
				new google.maps.LatLng(userCoordinates.lat ,userCoordinates.lng),
				map,
				{
					marker_id: 'start',
				},


			);

		bounds.extend(marker.latlng)
		for(coordinate in coordinates){

			let marker = new CustomMarker (
				new google.maps.LatLng(coordinates[coordinate].lat ,coordinates[coordinate].lng),
				map,
				{
					marker_id: count,
					marker_pin: count + 1,
				},
			);
			count ++

			markers.push(marker)

			bounds.extend(marker.latlng)
		}

		map.fitBounds(bounds)

	}

	google.maps.event.addDomListener(window, 'load', initialize);
	$(document).ready(function() {
		initMap();
	})

</script>
@stop