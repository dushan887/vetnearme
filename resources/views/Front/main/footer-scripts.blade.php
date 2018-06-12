<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script>
<!-- BOOTSTRAP 4 SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&libraries=places&callback=initMap"
        async defer></script> -->
<script type="text/javascript">
	$('#menu-btn').click(function() {
		$('body').toggleClass('nav-in');
	});
	$('#advanced-search').on('change', function() {
		if ($(this).prop('checked')) {
			$('body').addClass('search-in');
		} else {
			$('body').removeClass('search-in');
		}
	})
	function initMap() {
        var input = document.getElementById('address-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
      }

    var background = ["banner", "banner2", "banner3", "banner4", "banner5"];
	function getMessage() {
	   return background[Math.floor(Math.random() * background.length)];
	}
	var newbg = 'url(/img/'+getMessage()+'.jpg)';
	$('#swap-bg').css('background-image', newbg)

	// Get the clinics based on radius

	$('body').on('change', '#radius, #working', function(){

		let data  = $('#search').serialize() + '&radius=' + $('#radius').val() + '&working=' + $('#working').val()

		window.location.replace('/results?' + data)

		{{-- $.ajax({
			url: '/results',
			data: data,
			dataType: 'json',
			success: (response) => {

				$('.clinics-container').html(response.page)
				$('.resaults-found').html(response.total)
				$('.search-input').html(response.address)

				window.history.pushState(null, null, '/results?' + data)

				let content         = $('#gmap-data')
				let coordinates     = content.data('coordinates')
				let userCoordinates = content.data('usercoordinates')

				let count  = 1

			}
		}); --}}

	})
</script>
