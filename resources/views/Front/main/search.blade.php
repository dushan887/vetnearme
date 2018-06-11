<form
	id="search" action="/results" method="get">
	<div class="search-title">
		<h1 class="white-color">Find Your Nearest Vet</h1>
	</div>
	<!-- SEARCH -->
	<div class="search-wrapper">
		<div class="field location-search">
			<input id="address-input"
				name="address-input"
				class="border-main-color"
				type="text"
				placeholder="Enter suburb, town, city or postcode" />
			<div class="search-category raido-checkbox radio">
				<ul class="list-unstyled">
				  <li>
				    <input type="radio" id="f-option" name="selector-category" checked value="all">
				    <label for="f-option">All</label>

				    <div class="check"></div>
				  </li>

				  <li>
				    <input type="radio" id="s-option" name="selector-category" value="general">
				    <label for="s-option">General practice</label>

				    <div class="check"><div class="inside"></div></div>
				  </li>

				  <li>
				    <input type="radio" id="t-option" name="selector-category" value="specialist">
				    <label for="t-option">Specialist and Emergency </label>

				    <div class="check"><div class="inside"></div></div>
				  </li>
				</ul>
			</div>
		</div>
		<div class="field submit-search">
			<div class="search-btn-icon">
				<input class="submit border-main-color main-btn" type="submit" value="Search" />
			</div>

			<div class="raido-checkbox advanced-search">
				<ul class="list-unstyled">
				  <li>
				    <input type="checkbox" id="advanced-search">
				    <label for="advanced-search">Advanced Search</label>

				    <div class="check"></div>
				  </li>
				</ul>
			</div>


		</div>
	</div>
	<!-- END SEARCH -->

	<!-- ADVANCED SEARCH -->
	<div class="advanced-search-holder">
		<div class="advanced-search-container border-main-color2" style="margin-top: 50px">
			<div class="row">

				<div class="form-field">

					@foreach($services as $service)
						<div class="button-container">
							<input type="checkbox" id="s-{{ $service->name }}" name="services[]" value="{{ $service->id }}">
							<label for="s-{{ $service->name }}">{{ $service->name }}</label>
							<div class="checked">
								<div class="inside"></div>
							</div>
						</div>
					@endforeach

				</div>

			</div>
		</div>
	</div>
	<!-- END ADVANCED SEARCH -->

</form>