<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script>
<!-- BOOTSTRAP 4 SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHP8bVjaRJ6qoHssTHUDmjN-LEOJJrt2Q&libraries=places&callback=initMap"
        async defer></script> -->

<script type="text/javascript">
	$('#search-toogle-btn').click(function() {
		$('#toogle-search').toggle('fast')
	})
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

    var background = ["banner", "banner2", "banner3", "banner4", "banner5", "banner6"];
	function getMessage() {
	   return background[Math.floor(Math.random() * background.length)];
	}
	var newbg = 'url(/img/'+getMessage()+'.jpg)';
	$('#swap-bg').css('background-image', newbg)

	// Get the clinics based on radius

	$('body').on('change', '#radius, input[name=working], input[name="services[]"]', function(){

		let data  = $('#search').serialize() + '&radius=' + $('#radius').val() + '&working=' + $('input[name=working]:checked').val()

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

	// Phone number/email tracking

	$('a[href^="tel:"]').click(function(){
		var telephonenumber=jQuery(this).attr('href');
		gtag('event', 'contact', { 'event_category' : 'Phone_Call_Tracking', 'event_action' : 'Click_to_Call', 'event_label' : telephonenumber});
		return true;
	});
	$('a[href^="mailto:"]').click(function(){
		var emaillink=jQuery(this).attr('href');
		gtag('event', 'contact', { 'event_category' : 'Email_Click_Tracking', 'event_action' : 'Click_to_Email', 'event_label' : emaillink});
		return true;
	});

</script>


<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>

<script type='text/javascript' src='https://s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->