<section style="background: #fff; padding: 15px;">
	<h4 class="main-color">SEARCH ARTICLES</h4>
	<form id="article-search">
		<div class="search-wrapper">
			<div class="field relative">
				<input class="border-main-color" type="text" placeholder="Article Search">
			</div>
		</div>
	</form>
	<div class="border-separator" style="margin-bottom: 18px;"></div>
	<h4 class="main-color">CATEGORIES</h4>
	<ul class="list-unstyled main-color2">

		@foreach($categories as $category)
			<li>
				<i class="fas fa-paw"></i>
				<a href="/blog/category/{{ strtolower($category->name) }}">{{ $category->name  }}</a>
			</li>
		@endforeach

	</ul>

	<div class="border-separator" style="margin-bottom: 18px;"></div>
	<h4 class="main-color">RECENT POSTS</h4>
	<ul class="list-unstyled main-color2">

		@foreach($posts as $post)
			<li>
				<i class="fas fa-paw"></i>
				<a href="/blog/{{ $post->permalink }}">{{ $post->title }}</a>
			</li>
		@endforeach

	</ul>
</section>