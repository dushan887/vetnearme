<!DOCTYPE html>
<html lang="en">
<head>
	@include('Front.main.head-scripts')	
	@yield('SEOinfo')
	@yield('AditionalHead')
</head>
{{-- Page setup --}}
@yield('BodySetup')

	

	@include('Front.main.footer-scripts')
	@yield('AditionalFoot')	

</body>
</html>


