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
</script>

<script type="text/javascript">

	let advancedSearch = $('#advanced-search')

	if(advancedSearch.prop('checked')){
		$('body').addClass('search-in');
	}

	$('#advanced-search').on('change', function() {
		if ($(this).prop('checked')) {
			$('body').addClass('search-in');
		} else {
			$('body').removeClass('search-in');
		}
	})

	$('#f-option1').on('change', function() {
		if ($(this).prop('checked')) {
			$('#address-input').attr('placeholder', 'Enter suburb, town, city or postcode');
			$('#address-input').parent().removeClass('by-address').removeClass('by-name').removeClass('by-doctor');
			$('#address-input').parent().addClass('by-address')
		}
	})
	$('#s-option2').on('change', function() {
		if ($(this).prop('checked')) {
			$('#address-input').attr('placeholder', 'Enter clinics name');
			$('#address-input').parent().removeClass('by-address').removeClass('by-name').removeClass('by-doctor');
			$('#address-input').parent().addClass('by-name')
		}
	})
	$('#t-option3').on('change', function() {
		if ($(this).prop('checked')) {
			$('#address-input').attr('placeholder', 'Enter doctors first or last name');
			$('#address-input').parent().removeClass('by-address').removeClass('by-name').removeClass('by-doctor');
			$('#address-input').parent().addClass('by-doctor')
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

	$('body').on('change', '#radius', function(){

		let $this = $(this)
		let data  = $('#search').serialize() + '&radius=' + $this.val()

		$.ajax({
			url: '/results',
			data: data,
			dataType: 'json',
			success: (response) => {
				$('#content').html(response.page)
			}
		});

	})
</script>
