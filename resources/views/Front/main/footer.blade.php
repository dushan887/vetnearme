<div class="container">
	<div class="row">
		<div class="col-12 col-md-6">
			<span>© <strong>Vet</strong> Near Me, {{ date("Y") }}. All Rights Reserved.</span>
		</div>
		<div class="col-12 col-md-6">
			<ul class="list-unstyled list-inline mb-0">
				<li class="list-inline-item"><a href="{{ URL::to('/privacy-policy') }}">Privacy</a></li>
				<li class="list-inline-item"><a href="{{ URL::to('/sitemap') }}">Sitemap</a></li>
				<li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#subscribe-modal">Feedback</a></li>
				<li class="list-inline-item"><a href="{{ URL::to('/login') }}">Sign In</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="modal fade" id="subscribe-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"  style="color: #468a97 !important">Subscribe to our mailing list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="mc_embed_signup">
			<form action="https://desimphony.us19.list-manage.com/subscribe/post?u=473d1571bdd5c85ed5b7ba449&amp;id=d8d5884853" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			    <div id="mc_embed_signup_scroll">
			<div class="mc-field-group">
				<label for="mce-EMAIL"  style="color: #468a97 !important">Email Address  <span class="asterisk">*</span>
			</label>
				<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
			</div>
				<div id="mce-responses" class="clear">
					<div class="response" id="mce-error-response" style="display:none"></div>
					<div class="response" id="mce-success-response" style="display:none"></div>
				</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
			    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_473d1571bdd5c85ed5b7ba449_d8d5884853" tabindex="-1" value=""></div>
			    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
			    </div>
			</form>
		</div>
      </div>
    </div>
  </div>
</div>
