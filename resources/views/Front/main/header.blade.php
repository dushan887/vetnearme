<div class="container-fluid">
	<nav class="navbar">
	  	<div>
	  		<div class="logo">
	  			<a href="{{ URL::to('/') }}"><img src="{{ URL::asset('/img/logo-w.png') }}" style="max-height: 40px"></a>
	  		</div>
	  	</div>
	 	<div id="menu-btn">
			<div></div>
			<div></div>
			<div></div>
		</div>
		<div id="sign-in">
			<a href="{{ URL::to('/login') }}">Sign In</a>
		</div>
		<div id="main-nav">
			<div class="side-logo">
				<a href="#">
					<img src="{{ URL::asset('/img/l1.png') }}" width="80" height="80" alt="">
				</a>
			</div>
			<ul>
				<li>
					<a href="{{ URL::to('/results?address-input=Australia&selector-category=alll&radius=all') }}">View Clinics</a>
				</li>
			</ul>
		</div>
	</nav>
</div>
