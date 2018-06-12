<section id="search-resaults">
	<div class="container">
		<div class="row">
			<div class="col-9">
				<div><span class="resaults-found main-color">{{ $clinics->total() }}</span> <span>nearby for search for</span> <span class="search-input">{{ $address }}</span></div>
			</div>
			<div class="col-3" style="text-align: right;"><span>
				<?php
					if($clinics->currentPage() === 1):
						$to = $clinics->perPage() >= $clinics->total() ? $clinics->total() :$clinics->perPage();

						$showing = "1 - {$to}" ;
					else:
						$from    = ($clinics->currentPage() * $clinics->perPage()) - 1;
						$to      = ($from + $clinics->perPage()) - 1;
						$to      = $clinics->total() <= $to ? $clinics->total() : $to;
						$showing = "{$from} - {$to}";
					endif
				?>
				Showing <span id="clinics-showing">{{ $showing }}</span> of
				<span class="resaults-found">{{ $clinics->total() }}</span></span></div>
		</div>

		<div class="border-separator"></div>

		<div class="row">
			<div class="col-12">
				<div>
					<ul class="bottom-filters list-unstyled">
						<li><i class="fa fa-filter" style="font-size: 20px;"></i></li>
						<li id="distance-filter" class="select">
							<span>Distance</span>
							<select name="radius" id="radius">
								<option value="10">10km</option>
								<option value="20">20km</option>
								<option value="30">30km</option>
								<option value="50">50km</option>
								<option value="100">100km</option>
								<option value="all">Show All</option>
							</select>
						</li>
						<li id="open-hours-filter" class="select">
							<span>Open Clinics</span>
							<select>
								<option value="open">Open Now</option>
								<option value="closed">Closed</option>
							</select>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="visual-resaults" class="row">
			<div class="clinics-container col-12 col-md-7">
				@include('Front.results.partials._clinics')
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