<section class="blog-grid grid-3x3">
	<div class="row">

		@foreach ($relatedPosts as $post)

		<div class="col-12 col-md-4">
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
					</div>
				</article>
			</div>

		@endforeach

	</div>
</section>