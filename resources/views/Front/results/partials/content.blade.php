<section id="search-resaults">
	<div class="container">
		<div class="row">
			<div class="col-9">
				<div>
					<?php
						if($clinics->currentPage() === 1):
							$to = $clinics->perPage() >= $clinics->total() ? $clinics->total() :$clinics->perPage();

							$showing = "1 - <span class=total-clinics>{$to}</span>" ;
						else:
							$from    = ($clinics->currentPage() * $clinics->perPage()) - 1;
							$to      = ($from + $clinics->perPage()) - 1;
							$to      = $clinics->total() <= $to ? $clinics->total() : $to;
							$showing = "{$from} - {$to}";
						endif
					?>
					Showing <span id="clinics-showing">{!! $showing !!}</span> of
					<span class="resaults-found main-color">{{ $clinics->total() }}</span>

					<span>nearby for search for</span> <span class="search-input">{{ $address }}</span>
				</div>
			</div>
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
								@foreach($radius as $rad)
									<option
										value="{{ $rad }}"
										@if(isset($radiusSelected) && $radiusSelected == $rad)
											selected="selected"
										@endif
									>{{ $rad }}km</option>
								@endforeach
							</select>
						</li>
						<li id="open-hours-filter" class="select">

							<label for="clinics-all">
								All clinics
								<input type="radio" name="working" value="all" id="clinics-all"
								@if($working === 'all')
									checked="checked"
								@endif>
							</label>

							<label for="clinics-open">
								Open Clinics
								<input type="radio" name="working" value="open" id="clinics-open"
								@if($working === 'open')
									checked="checked"
								@endif
								>
							</label>

						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="visual-resaults" class="row">
			<div class="clinics-container col-12 col-lg-6 ds-col-45">
				<div class="inner"
				id="gmap-data"
				data-coordinates="{{ $coordinates ?? '' }}"
				data-usercoordinates="{{ $userCoordinates }}"
				>
					@php
						$count = 0;
					@endphp
					<ul class="list-unstyled" id="clinics">
						@include('Front.results.partials._clinics')
					</ul>

				</div>
			</div>
			<div class="col-12 col-lg-6 ds-col-55">
				<div class="inner">
					<div id="map" style="width: 100%; height: 100%; display: block;"></div>
				</div>
			</div>
		</div>
	</div>
</section>