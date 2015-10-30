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
        	@foreach( range(1, 9) as $a )
	            <div class="col-md-4 portfolio-item">
	                <a href="#">
	                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
	                </a>
	                <h5 class="text-center">
	                    <a href="#">John Jackson</a>
	                </h5>
	            </div>
        	@endforeach
			<nav class="text-center">
				<ul class="pagination">
				    <li>
				      <a href="#" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				        <span class="sr-only">Previous</span>
				      </a>
				    </li>
				    <li><a href="#">1</a></li>
				    <li><a href="#">2</a></li>
				    <li><a href="#">3</a></li>
				    <li><a href="#">4</a></li>
				    <li><a href="#">5</a></li>
				    <li>
				      <a href="#" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				        <span class="sr-only">Next</span>
				      </a>
				    </li>
				    				
				</ul>
			</nav>
        </div>
	</div>


@endsection

@section('footer')
	@include('_partial/footer')
@endsection