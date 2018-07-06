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
	<ul>

		@foreach($categories as $category)
			<li>
				<i class="fs fa-paw"></i>
				<a href="/blog/category/{{ strtolower($category->name) }}">{{ $category->name  }}</a>
			</li>
		@endforeach

	</ul>
	<div class="border-separator" style="margin-bottom: 18px;"></div>
	<h4 class="main-color">RECENT POSTS</h4>
	<ul>

		@foreach($recentPosts as $recent)
			<li>
				<i class="fa fa-paper-plane"></i>
				<a href="/blog/{{ $recent->permalink }}">{{ $recent->title }}</a>
			</li>
		@endforeach

	</ul>
</section>