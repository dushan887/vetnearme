<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
	$('#advanced-search').on('change', function() {
		if ($(this).prop('checked')) {
			$('body').addClass('search-in');
		} else {
			$('body').removeClass('search-in');
		}
	})
	$('#search .submit').on('click', function(e) {
		e.preventDefault();
		window.location.href='/'; 

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
</script>
