<section class="blog-grid grid-3x3">
	<div class="row">

		@foreach($posts as $post)

			<div class="col-12 col-md-4">

				<article class="border-main-color">

					<header>
						<a href="/blog/{{ $post->permalink }}">
							<div class="cover-img"
								style="background-image: url({{ asset('/postsCover/' . $post->cover_image) }});"></div>
						</a>
					</header>

					<div class="article-body">
						<h3><a href="/blog/{{ $post->permalink }}">{{ $post->title }}</a></h3>
						<p>{{ $post->expert }}</p>
					</div>

					<footer>
						<div class="row">
							<div class="col-12 col-md-6 align-left">
								<a href="#">{{ $post->category->name }}</a>
							</div>
							<div class="col-12 col-md-6 align-right">
								<a href="/blog/{{ $post->permalink }}">read more...</a>
							</div>
						</div>
					</footer>

				</article>

			</div>

		@endforeach

	</div>
</section>