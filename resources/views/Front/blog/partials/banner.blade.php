<section id="swap-bg" class="banner border-main-color2">
	<div class="banner-inner">
		<div class="container">
			<?php
				if(isset($categoryName))
					$categoryName = ucfirst($categoryName);
			?>
			<h1>{{ $post->title ?? $categoryName ?? 'Pet News & Advice' }}</h1>
		</div>
	</div>
</section>