<section class="blog-grid home-blog">
	<div class="row">

		@foreach($posts as $post)

			<div class="col-12 col-md-6 col-lg-4">
				<article>

					<header>
						<a href="/{{ $post->permalink }}">
							<div class="cover-img"
								style="background-image: url({{ asset('/postsCover/thumbs/' . $post->cover_image) }});"></div>
						</a>
					</header>

					<div class="article-body">
						<h3>
							<a href="/{{ $post->permalink }}">{{ $post->title }}</a>
						</h3>
						{{-- <p>{{ $post->expert }}</p> --}}
					</div>

					</footer>
				</article>
			</div>

		@endforeach
	</div>

		<div class="row">
			<div class="col-12" align="center">
				<br>
				<a href="{{ URL::to('/blog') }}" class="load-more">View more articles...</a>
			</div>
		</div>
</section>