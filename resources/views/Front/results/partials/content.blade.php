<section id="search-resaults">
	<div class="container">
		<div class="row">
			<div class="col-9">
				<div><span class="resaults-found main-color">546 found</span> <span>nearby for search for</span> <span class="search-input">Vet Clinic in Greater Sydney, NSW</span></div>
			</div>
			<div class="col-3" style="text-align: right;"><span>
				<?php
					$showing = 33;

					if($clinics->currentPage() === 1):
						$showing = "1 - " . $clinics->perPage();
					else:
						$from    = ($clinics->currentPage() * $clinics->perPage()) - 1;
						$to      = ($from + $clinics->perPage()) - 1;
						$to      = $clinics->total() <= $to ? $clinics->total() : $to;
						$showing = "{$from} - {$to}";
					endif
				?>
				Showing {{ $showing }} of {{ $clinics->total() }}</span></div>
		</div>

		<div class="border-separator"></div>

		<div class="row">
			<div class="col-12">
				<div>
					<ul class="bottom-filters list-unstyled">
						<li><i class="fa fa-filter" style="font-size: 20px;"></i></li>
						<li id="distance-filter" class="select">
							<span>Distance</span>
							<select>
								<option value="">10km</option>
								<option value="">20km</option>
								<option value="">30km</option>
								<option value="">50km</option>
								<option value="">100km</option>
								<option value="">Show All</option>
							</select>
						</li>
						<li id="open-hours-filter" class="select">
							<span>Open Clinics</span>
							<select>
								<option value="">Open Now</option>
								<option value="">Closed</option>
							</select>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="visual-resaults" class="row">
			<div class="col-12 col-md-7">
				<div class="inner">
					<ul class="list-unstyled">

						@foreach($clinics as $clinic)

							<?php $hours = json_decode($clinic->opening_hours) ?>

							<li class="item">
								<div class="resault">
									<div class="resault-logo">
										<a href="#">
											<img src="{{ $clinic->logo ?
												'img/logo/' . $clinic->logo :
												'http://via.placeholder.com/120x80'}}"
											alt="{{ $clinic->name }} Logo">
										</a>
									</div>
									<div class="reasault-info">
										<div class="resault-title">
											<h4>{{ $clinic->name }}</h4>
										</div>
										<div class="resault-description">
											<p>{{ $clinic->description	}}</p>
											<a href="#">View more...</a>
										</div>
									</div>
									<div class="resault-address">
										<span>{{ $clinic->address }}</span><br />
										<span>{{ $clinic->city }}</span><br />
										<span>{{ $clinic->country->name . " " . $clinic->zip }}</span><br />
									</div>
								</div>
								<div class="border-separator space-12"></div>
								<div class="resault">
									<div class="resault-phone">
										<a href="tel:{{ preg_replace('/\D/', '', $clinic->phone_number) }}">
											<i class="fa fa-phone"></i>
											<span>{{ $clinic->phone_number }}</span>
										</a>
									</div>
									<div class="resault-email">
										<a href="mailto:{{ $clinic->email }}">
											<i class="fa fa-envelope"></i>
											<span>{{ $clinic->email }}</span>
										</a>
									</div>
									<div class="resault-web">
										<a href="{{ $clinic->url }}" target="_blank"
											rel="nofollow noopener noreferrer">
											<i class="fa fa-globe"></i>
											<span>{{ $clinic->url }}</span></a>
									</div>
								</div>
								<div class="border-separator space-12"></div>
								<div class="resault">
									<div class="rasault-rating">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
									</div>
									<div class="resault-directions">
										<a href="{{ $clinic->gmaps_link }}" target="_blank"
											rel="nofollow noopener noreferrer">
											<i class="fa fa-map-signs"></i>
											Get Directions
										</a>
									</div>

									@if(isClinicOpen($hours, $currentDay, $currentHour))
										<div class="resault-open align-right">
											<span class="checked"></span>
										</div>
									@else
										<div class="resault-open align-right">
											<span></span>
										</div>
									@endif
								</div>

							</li>

						@endforeach

					</ul>

					{{ $clinics->links() }}

				</div>

			</div>
			<div class="col-12 col-md-5">
				<div class="inner">
					<div id="map" style="width: 100%; height: 100%; display: block;"></div>
				</div>
			</div>
		</div>
	</div>
</section>