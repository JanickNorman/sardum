@extends('main')
@section('header')
	@include('_partial/header')
@endsection

@section('content')
	<div class="container">
		<h3><strong>Gallery Sardumoment</strong></h3>
		<h5>Lihat foto Sardumoment, menangkan berlian beserta isi dunia!</h5>
<!-- Projects Row -->
        <div class="row">
        	@foreach( $data['photos'] as $photo )
	            <div class="col-md-4 portfolio-item">
	                <a href="{{route('show.photo', [$photo['id']])}}">
	                    <img class="img-responsive" width="200" src="{{ $photo['image'] }}" alt="">
	                </a>
	                <h5 class="text-center">
	                    <a href="#">{{$photo['uploader']['nama']}}</a>
	                </h5>
	            </div>
        	@endforeach
        </div>
        <div class="row">		
			<nav class="text-center">
				{!! $data['photos']->render()!!}
			</nav>
        </div>
	</div>


@endsection

@section('footer')
	@include('_partial/footer')
@endsection