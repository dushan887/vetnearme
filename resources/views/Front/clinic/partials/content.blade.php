<section>
	<div class="container" style="max-width: 992px;">
		<div class="wrapper bg-main-color2 pl-0 pr-0" id="clinic" data-lat="{{ $clinic->lat }}" data-lng="{{ $clinic->lng }}">
			<div class="clinic-header">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="clinic-logo">
							<img src="/img/logo/{{ $clinic->logo }}" alt="{{ $clinic->name }} Logo">
						</div>
					</div>
					<div class="col-12 col-md-8">
						<div class="rasault-rating">
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
						</div>
						<div class="clinic-name">
							<h1 class="main-color">{{ $clinic->name }}</h1>
						</div>
						<div id="clinic-nav">
							<ul>


							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="row inner-sections">
				<div class="col-12 col-md-8">
					<div class="inner empty">
						<div id="clinicSliderCarousel" class="carousel slide" data-ride="carousel">
						  <ol class="carousel-indicators">

							  <?php $counter = 0  ?>

							  @foreach($clinic->gallery as $media)
								<li data-target="#clinicSliderCarousel"
								data-slide-to="{{ $counter }}"
								@if($clinic === 0)
									class="active"
								@endif
								></li>

								<?php $clinic++ ?>
							  @endforeach

						  </ol>

						  <div class="carousel-inner clinic-gallery">
							@foreach($clinic->gallery as $media)
								<div class="carousel-item">
									<div
										class="d-block w-100 gallery-item"

										@if ($media->media->super_admin)
											style="background-image: url('/media/general/{{ $media->media->name }}') !important"
										@else
											style="background-image: url('/media/{{ strtolower(str_replace(' ', '-', $clinic->name)) }}/{{ $media->media->name }}') !important"
										@endif
									></div>

								</div>
							@endforeach
						  </div>

						  <a class="carousel-control-prev" href="#clinicSliderCarousel" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#clinicSliderCarousel" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="inner">
						<h4 class="main-color">Contact Details</h4>
						<div class="border-separator space-10"></div>
						<ul class="list-unstyled info">
							<li><a href="tel:{{ $clinic->phone_number }}"><i class="fas fa-phone-square"></i> <strong>Phone:</strong><br />
								<span style="margin-top: 0">{{ $clinic->phone_number }}</span></a></li>
							<li><a href="tel:{{ $clinic->emergency_number }}"><i class="fas fa-phone-square"></i> <strong>Emergency:</strong><br />
								<span style="margin-top: 0">{{ $clinic->emergency_number }}</span></a></li>
							<li><a href="mailto:{{ $clinic->email }}"><i class="fas fa-envelope-square"></i> <strong>Email:</strong><br />
								<span style="margin-top: 0">{{ $clinic->email }}</span></a></li>
							<li id="web-url-check">
								<a href="{{ $clinic->url }}" 
									rel="nofollow noopener noreferrer" target="_blank"
									onclick="trackOutboundLink('{{ $clinic->url }}'); return false">
									<i class="fas fa-globe"></i> <strong>Website:</strong><br />
								<span style="margin-top: 0">{{ $clinic->url }}</span></a></li>
							<li>
								<div class="border-separator space-10"></div>
								<strong class="main-color">Social:</strong>
								<ul class="list-unstyled social-list">
									@foreach($social as $key => $value)

										<li>
											<a href="{{ $value }}">
												<?php $square = '' ?>
												@if(in_array($key, ['facebook', 'twitter', 'youtube']))
													<?php $square = '-square' ?>
												@endif
												<i class="fab fa-{{ $key . $square}}"></i>
											</a>
										</li>

									@endforeach
									<li style="float: right;width: auto;">

											<a href="{{ $clinic->bookmark_url }}" target="_blank" rel="nofollow noopener noreferrer" style="white-space: nowrap; display: inline-block; float: right;">
							                    <i class="fas fa-calendar-alt" style="white-space: nowrap; display: inline-block;"></i> <strong>Book Now</strong>

							                </a>
									</li>

								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="row inner-sections">
				<div class="col-12 col-md-8">
					<div class="inner">
						<h4 class="main-color">About {{ $clinic->name }}</h4>
						<div class="border-separator space-10"></div>
						{!! $clinic->description !!}
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="inner">
						<h4 class="main-color">Opening Hours</h4>
						<div class="border-separator space-10"></div>
						<ul class="list-unstyled main-color opening-hours">
							<li><strong>Monday:</strong>
								<span>
									@if(!$hours->{'monday-from'})
										Closed
									@else
										{{ $hours->{'monday-from'} }} - {{ $hours->{'monday-to'} }}
									@endif

									@if ($hours->{'monday-from2'} !== '00:00' && $hours->{'monday-to2'} !== '00:00')
										<br /> {{ $hours->{'monday-from2'}  }} - {{ $hours->{'monday-to2'} }}
									@endif

								</span>
							</li>

							<li><strong>Tuesday:</strong>
								<span>
									@if(!$hours->{'tuesday-from'})
										Closed
									@else
										{{ $hours->{'tuesday-from'} }} - {{ $hours->{'tuesday-to'} }}
									@endif

									@if ($hours->{'tuesday-from2'} !== '00:00' && $hours->{'tuesday-to2'} !== '00:00')
										<br /> {{ $hours->{'tuesday-from2'}  }} - {{ $hours->{'tuesday-to2'} }}
									@endif

								</span>
							</li>

							<li><strong>Wednesday:</strong>
								<span>
									@if(!$hours->{'wednesday-from'})
										Closed
									@else
										{{ $hours->{'wednesday-from'} }} - {{ $hours->{'wednesday-to'} }}
									@endif

									@if ($hours->{'wednesday-from2'} !== '00:00' && $hours->{'wednesday-to2'} !== '00:00')
										<br /> {{ $hours->{'wednesday-from2'}  }} - {{ $hours->{'wednesday-to2'} }}
									@endif

								</span>
							</li>

							<li><strong>Thursday:</strong>
								<span>
									@if(!$hours->{'thursday-from'})
										Closed
									@else
										{{ $hours->{'thursday-from'} }} - {{ $hours->{'thursday-to'} }}
									@endif

									@if ($hours->{'thursday-from2'} !== '00:00' && $hours->{'thursday-to2'} !== '00:00')
										<br /> {{ $hours->{'thursday-from2'}  }} - {{ $hours->{'thursday-to2'} }}
									@endif

								</span>
							</li>

							<li><strong>Friday:</strong>
								<span>
									@if(!$hours->{'friday-from'})
										Closed
									@else
										{{ $hours->{'friday-from'} }} - {{ $hours->{'friday-to'} }}
									@endif

									@if ($hours->{'friday-from2'} !== '00:00' && $hours->{'friday-to2'} !== '00:00')
										<br /> {{ $hours->{'friday-from2'}  }} - {{ $hours->{'friday-to2'} }}
									@endif

								</span>
							</li>

							<li><strong>Saturday:</strong>
								<span>
									@if(!$hours->{'saturday-from'})
										Closed
									@else
										{{ $hours->{'saturday-from'} }} - {{ $hours->{'saturday-to'} }}
									@endif

									@if ($hours->{'saturday-from2'} !== '00:00' && $hours->{'saturday-to2'} !== '00:00')
										<br /> {{ $hours->{'saturday-from2'}  }} - {{ $hours->{'saturday-to2'} }}
									@endif

								</span>
							</li>

							<li><strong>Sunday:</strong>
								<span>
									@if(!$hours->{'sunday-from'})
										Closed
									@else
										{{ $hours->{'sunday-from'} }} - {{ $hours->{'sunday-to'} }}
									@endif

									@if ($hours->{'sunday-from2'} !== '00:00' && $hours->{'sunday-to2'} !== '00:00')
										<br /> {{ $hours->{'sunday-from2'}  }} - {{ $hours->{'sunday-to2'} }}
									@endif

								</span>
							</li>

							<li class="note">{{ $clinic->special_notes }}</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="row inner-sections">
				<div class="col-12 col-md-8">
					<div class="inner empty">
						<div id="map" class="clinic-map-pin" style="width: 100%; height:340px; display: block;"></div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="inner">
						<h4 class="main-color">Clinic Location</h4>
						<div class="border-separator space-10"></div>
						<ul class="list-unstyled main-color info">
							<li><i class="fas fa-map-marker-alt"></i>
									<strong>Address:</strong>
									<span>{{ $clinic->address }}</span>
									<span>{{ $clinic->city }}, {{ $clinic->state }} {{ $clinic->zip }}</span>
									<span>{{ $clinic->country->name }}</span>
							</li>
							<li>
								<div id="map2" style="opacity: 0;visibility: hidden;position: absolute;"></div>
								<div class="location-search" style="position: relative; display: block">
									<div id="loc-btn"><img src="/img/gps-fixed-indicator.png"></div>
									<input id="address-input" type="text" placeholder="Your Address">
								</div>
								<div id="disable-loc">
									<a id="ds-loc" href="https://www.google.com/maps/dir/{{ $clinic->address }} {{ $clinic->city }}, {{ $clinic->state }} {{ $clinic->zip }} {{ $clinic->country->name }}" ds-loc="{{ $clinic->address }} {{ $clinic->city }}, {{ $clinic->state }} {{ $clinic->zip }} {{ $clinic->country->name }}"><i class="fas fa-map-signs"></i> <strong> Get Directions</strong></a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="row inner-sections">
				<div class="col-12 col-md-12">
					<div class="inner">
						<h4 class="main-color">Clinic Services</h4>
						<div class="border-separator space-10"></div>
						<ul class="list-unstyled main-color service-list">

							@foreach($clinic->services as $service)
								<li>{{ $service->name }}</li>
							@endforeach

						</ul>
					</div>
				</div>
			</div>

			{{-- <div class="row inner-sections">
				<div class="col-12 col-md-4">
					<div class="inner">
						<h4 class="main-color">Doctors</h4>
						<div class="border-separator space-10"></div>
						<ul class="list-unstyled main-color clinic-doctors">
							<li><div class="doctor-img"><img src="http://via.placeholder.com/150x150" alt=""></div> <span>Dr. Louise Stevenson <small>B.V.Sc and Hospital Director</small></span></li>
							<li><div class="doctor-img"><img src="http://via.placeholder.com/150x150" alt=""></div> <span>Dr. Adrienne Pegler <small>B.V.Sc</small></span></li>
							<li><div class="doctor-img"><img src="http://via.placeholder.com/150x150" alt=""></div> <span>Dr. Natalie Tredrea <small>B.V.Sc</small></span></li>
							<li><div class="doctor-img"><img src="http://via.placeholder.com/150x150" alt=""></div> <span>Dr. Katherine Ardlie <small>B.V.Sc</small></span></li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-md-8">
					<div class="inner">
						<h4 class="main-color">Book Now</h4>
						<div class="border-separator space-10"></div>

					</div>
				</div>
			</div> --}}

		</div>
	</div>
</section>