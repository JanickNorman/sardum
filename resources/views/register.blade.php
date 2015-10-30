@extends('main')

@section('header')
	@include('_partial/header')
@endsection

@section('content')
	<div class="container">
		<div class="alert alert-danger text-center" role="alert">
		  <a href="#" class="alert-link">Masukan data dirimu dengan lengkap</a>
		</div>
		<h4>Registrasi</h4>
		<h6>Isi data dirimu dengan lengkap dan jelas</h6>
		<form action="/register" method="post">
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<div class="row">
				<div class="col-md-6">
					<label for="nama">Nama</label><br>
					@if (Session::has('social_name'))
						<input style="width: 100%" name="nama" value="{{Session::get('social_name')}}">
					@else
						<input id="nama" name="nama" style="width: 100%" type="text">				
					@endif
				</div>
				<div class="col-md-6">
					<label for="email">Email</label><br>
					<input id="email" name="email" style="width: 100%" type="email">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="tanggal_lahir">Tanggal Lahir</label>
					<br>
					<div class="input-group date">
						{!! Form::datetime('event_date') !!}
					</div>	
				</div>
				<div class="col-md-6">
					<label for="nomer_handphone">Nomer Handphone</label><br>
					<input id="nomer_handphone" nama="nomer_handphone" style="width: 100%" type="text">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label for="alamat">Alamat</label><br>
					<input id="alamat" name="alamat" style="width: 100%; height: 75px" type="text">				
				</div>
			</div>
			<h6>*all mandatory</h6>			
			<input class="btn btn-large" type="submit">
			<br>
			<h6>By clicking this button, you agree to terms & conditions</h6>
		</form>
	</div>

@endsection

@section('footer')
	@include('_partial/footer')
@endsection
