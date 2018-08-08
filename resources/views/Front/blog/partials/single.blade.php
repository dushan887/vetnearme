<section>
	<div class="container" style="max-width: 1170px;">
		<div class="wrapper bg-main-color2">
			<div class="row inner-sections ml-0 mr-0 pb-3 pt-3">
				<div class="col-md-12">
					<div class="inner empty">
						<img src="{{ asset('/postsCover/' . $post->cover_image) }}"
						alt="{{ $post->title }}">
					</div>
				</div>
			</div>

			<div class="row inner-sections  ml-3 mr-0 pb-3">
				<div class="col-12 col-md-8 bg-white pb-3 pt-3">
					<div class="inner">
						<h4 class="main-color">{{ $post->title }}</h4>
						<div class="border-separator space-10"></div>

						{!! $post->body !!}
					</div>
				</div>
				<div class="col-12 col-md-4">
					@include('Front.home.partials.sidebar')
				</div>
			</div>

			<div class="row inner-sections ml-3 mr-3 pb-3 related">
				<div class="col-md-12 bg-white pb-3 pt-3">
					<div class="inner">
						<h4 class="main-color">Related Articles</h4>
						<div class="border-separator space-10"></div>
						@include('Front.blog.partials.related')
					</div>
				</div>
			</div>


		</div>
	</div>
</section>