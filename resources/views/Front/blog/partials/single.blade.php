<section>
	<div class="container" style="max-width: 1170px;">
		<div class="wrapper bg-main-color2">	
			<div class="row inner-sections">
				<div class="col-md-12" style="margin-top: 20px">
					<div class="inner empty">
						<img src="{{ asset('/img/post2.jpg') }}" alt="">
					</div>
				</div>					
			</div>

			<div class="row inner-sections">
				<div class="col-12 col-md-8">
					<div class="inner">
						<h4 class="main-color">What is lorem ipsum?</h4>
						<div class="border-separator space-10"></div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt obcaecati nesciunt ducimus ea exercitationem deleniti dolore, voluptas, quis nisi atque sint quia animi voluptatibus provident excepturi id illo rerum? Inventore! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt obcaecati nesciunt ducimus ea exercitationem deleniti dolore, voluptas, quis nisi atque sint quia animi voluptatibus provident excepturi id illo rerum? Inventore!</p><br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt obcaecati nesciunt ducimus ea exercitationem deleniti dolore, voluptas, quis nisi atque sint quia animi voluptatibus provident excepturi id illo rerum? Inventore!</p><br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt obcaecati nesciunt ducimus ea exercitationem deleniti dolore, voluptas, quis nisi atque sint quia animi voluptatibus provident excepturi id illo rerum? Inventore! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt obcaecati nesciunt ducimus ea exercitationem deleniti dolore, voluptas, quis nisi atque sint quia animi voluptatibus provident excepturi id illo rerum? Inventore!</p><br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt obcaecati nesciunt ducimus ea exercitationem deleniti dolore, voluptas, quis nisi atque sint quia animi voluptatibus provident excepturi id illo rerum? Inventore!</p><br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
						<h4 class="main-color" style="margin-top: 20px;">Share this story on Social Media</h4>
						<div class="border-separator space-10"></div>
						<ul class="blog-social list-inline list-unstyled">
							<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i> Youtube</a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-google-plus"></i> Google</a></li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-md-4">
					@include('Front.home.partials.sidebar')
				</div>
			</div>

			<div class="row inner-sections">
				<div class="col-md-12" style="background: #fff; border-radius: 5px;">
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