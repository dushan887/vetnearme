@extends('Front.main.main-template')

@section('SEOinfo')
	<title>Vet Near Me - {{ $address }}</title>
@stop

@section('AditionalHead')
<style type="text/css">
	.page-search {
    	padding: 30px 0 10px 0;
	}
	.search-in.page .advanced-search-holder {
		width: 100%;
	}
	.search-input {
		text-transform: capitalize;
	}
	.search-category.raido-checkbox {
		visibility: hidden;
    	opacity: 0;
	}
</style>
@stop

@section('BodySetup')
	<body class="page results-page">
		<header id="header" class="has-border">
			@include('Front.main.header')
			@include('Front.results.partials.search')

		</header>

		<div id="wrapper">


			<div class="container page-content">
				<div
					id="content"
					data-coordinates="{{ $coordinates }}"
					data-usercoordinates="{{ $userCoordinates }}"
					data-urls="">

					@if ($clinics->total() > 0)
						@include('Front.results.partials.content')
					@else
						@include('Front.results.partials.no-result')
					@endif

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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&libraries=places&region=AU"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#search-resaults .search-input').text($('#search-resaults .search-input').text().replace(', Australia', '').replace('Australia', ''))
	})
</script>

@if ($clinics->total() > 0)
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

			innerdiv = document.createElement('span');
			innerimage = document.createElement('img');

			div.className = 'marker';

			if(self.args.marker_id !== 'start'){

				// MARKER IKONICA IDE OVDE
				let clinicMarker = $('#clinic-' + self.args.marker_id).data('marker')

				div.appendChild(innerimage).src = clinicMarker !== 'none' ? '/img/markers/' + clinicMarker : '/img/l1.png'
				div.appendChild(innerdiv);

			}


			if (typeof(self.args.marker_id) !== 'undefined') {
				div.dataset.marker_id = self.args.marker_id;
				div.dataset.marker_pin = self.args.marker_pin;
			}

			google.maps.event.addDomListener(div, "click", function(event) {

				google.maps.event.trigger(self, "click");

					let infoIndex = $(this).attr('data-marker_id')

					if (infoIndex != 'start') {
						if (!$(this).hasClass('open')) {

							let clinic = $('#clinic-' + infoIndex)

							let infoTitle   = clinic.find('.resault-title').html()
							let infoAddress = clinic.find('.resault-address').html()
							let infoEmail   = clinic.find('.resault-email').html()
							let infoPhone   = clinic.find('.resault-phone').html()
							let infoWeb     = clinic.find('.resault-web').html()

							$('.marker').removeClass('open')
							$(this).addClass('open').append(`
								<div class="info-window">
									<div class="info-title"><strong>${infoTitle}</div>
									<div class="info-address">${infoAddress}</div>
									<div class="info-email">${infoEmail}</div>
									<div class="info-phone">${infoPhone}</div>
									<div class="info-web">${infoWeb}</div>
								'</div>
								`)
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
			div.style.top = (point.y - 50) + 'px';
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

		google.maps.event.addListener(map, 'dragend', function() {

			let clinics   = $('.clinic')
			let clinicIDs = []

			for(i = 0; i < clinics.length; i++){

				clinicIDs.push(clinics[i].dataset.id)

			}

			$.get("/results", {
				coordinates: {
					lat: map.getCenter().lat(),
					lng: map.getCenter().lng(),
				},
				ids: clinicIDs,
				radius: $('#radius').val(),
				working: $('input[name=working]:checked').val()
			},
				function (data, textStatus, jqXHR) {
					$('#clinics').append(data.page)

					let coordinates = JSON.parse(data.coordinates)

					let count = data.count

					$('.total-clinics').text(data.clinicsTotal)
					$('.resaults-found').text(data.clinicsTotal)

					for(coordinate in coordinates){

						let marker = new CustomMarker (
							new google.maps.LatLng(coordinates[coordinate].lat ,coordinates[coordinate].lng),
							map,
							{
								marker_id: count,
								marker_pin: count,
							},
						);
						count++;
						markers.push(marker)

					}


				},
				"json"
			);
		});

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
@else
<script type="text/javascript">
var map;
let markers     	= []
let content     	= $('#content')
let userCoordinates = content.data('usercoordinates')

function initMap() {

  // Create the map.
	let pyrmont = userCoordinates

	let options = {
		  types: ["(regions)"],
		  componentRestrictions: {country: ["AU", "NZ"]}
		 };
	let input        = document.getElementById('address-input');
	let autocomplete = new google.maps.places.Autocomplete(input,options);

	map = new google.maps.Map(document.getElementById('map'), {
		center: pyrmont,
		zoom: 12
	});


  // Create the places service.
  var service = new google.maps.places.PlacesService(map);
  var getNextPage = null;



  // Perform a nearby search.
	service.nearbySearch(
		{location: pyrmont, radius: 5000, type: ['veterinary_care']},
		function(results, status) {
		if (status !== 'OK') return;
		createMarkers(results);
	});
}

function createMarkers(places) {
  var bounds = new google.maps.LatLngBounds();

  for (var i = 0, place; place = places[i]; i++) {
    var image = {
      url: '/img/map-pin.png',
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(40, 40)
    };

    var marker = new google.maps.Marker({
      map: map,
      icon: image,
      title: place.name,
      position: place.geometry.location,
      reference: place.reference
    });

    var infowindow = new google.maps.InfoWindow()

    var content =  ''

    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
	    return function() {
	    	var request = {
		        reference: this.reference
		    };

		    service.getDetails(request, function(place, status){

			    	var content = '<div class="info"><h4 class="info-title main-color"><strong>' + place.name + '</strong></h4>'
			        if(status == google.maps.places.PlacesServiceStatus.OK){
			            if(typeof place.formatted_address !== 'undefined'){
			                content += '<div class="info-det"><i class="fas fa-map-marker-alt"></i> ' + place.formatted_address + '</div>';
			            }

			            if(typeof place.formatted_phone_number !== 'undefined'){
			                content += '<div class="info-det"><i class="fas fa-phone"></i> <a href="tel:' + place.formatted_phone_number + '">' + place.formatted_phone_number + '</a></div>';
			            }

			            if(typeof place.website !== 'undefined'){
			                content += '<div class="info-det"><i class="fas fa-globe"></i> <a href="' + place.website + '">' + place.website + '</a></div>';

			            }

			            if(typeof place.opening_hours !== 'undefined'){
			            	 content += '<strong><i class="fas fa-clock"></i> Opening Hours</strong><br /><ul class="info-det list-unstyled"> ';
			            	for (var i = 0; i < place.opening_hours.weekday_text.length; i++) {

				               	var opening_hours_div = document.getElementById("opening-hours");
				                // var hours = document.createElement('div');
				                hours = '<li>'+place.opening_hours.weekday_text[i]+'</li>'
				               	content += hours;
				            }
			                content += '</ul>';

			            }
			            content +='</div>'
			        }
			        infowindow.setContent(content);
	       			infowindow.open(map,marker);
			});

	    };
	})(marker,content,infowindow));

    bounds.extend(place.geometry.location);
  }
  map.fitBounds(bounds);
}


$(document).ready(function() {
	initMap();
})
</script>
@endif
@stop