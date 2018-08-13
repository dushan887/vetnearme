<section id="search-resaults">
	<div class="container">
		

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
			<div class="col-12 col-md-12">
				<div class="inner">
					<div id="map" style="width: 100%; height: 100%; display: block; min-height: 600px"></div>
				</div>
			</div>
		</div>
	</div>
</section>