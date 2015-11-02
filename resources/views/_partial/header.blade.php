<nav class="navbar">
	<div class="jumbotron">
		<div class="container text-center">
			@if (Auth::guest())
				<h2>Register dengan social media</h2>
					<button class="btn btn-block btn-social btn-facebook">
						<i class="fa fa-facebook"></i>Sign up with Facebook
					</button>
					<button onclick="window.location='/login/twitter';" class="btn btn-block btn-social btn-twitter">
						<i class="fa fa-twitter"></i>Sign up with Twitter
					</button>
				</div>
			
			@else
				<h2>SARDUMOMENT</h2>
				<h5>Upload Fotomu Bersama sari gandum</h5>
				<strong>menangkan emas berlian beserta isi dunia</strong>
				<br>
				<br>
				<a href="#" class="btn btn-primary btn-lg">
					<span class="glyphicon glyphicon-upload"> 
					</span>
					Upload Foto mu sekarang!
				</a>
				<div class="row">
					<form action="photo/upload" method="post">
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
						<label class="control-label">Select File</label>
						<input id="input-1" name="photo" type="file" class="file">
						<input type="submit">
					</form>
				</div>
			@endif
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="btn-group" role="group" aria-label="...">
				<button type="button" class="btn btn-default">Gallery</button>
				<button type="button" class="btn btn-default">Mekanisme</button>
				<button type="button" class="btn btn-default">Syarat & Ketentuan</button>
			</div>
			@if(\Auth::check())
				<div class="btn-group pull-right" role="group" aria-label="...">
					<img src="tes.jpg" alt="..." class="img">
					<button type="button pull-right" class="btn btn-default">Anwar</button>
				</div>
			@endif
			<div class="span"></div>
		</div>
</nav>

