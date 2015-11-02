@extends('main')

@section('header')
	@include('_partial/header')
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<h5>Back to gallery</h5>
			<h3>Gallery Sardumoment</h3>
		</div>
		<div class="row" style="background-color: #ddd">
	        <div class="media-body text-center center-block">
				<div class="row" style="margin: 0 auto; display: inline-block">
					<img class="img-responsive" src="http://placehold.it/500x320.jpg" alt="">
					<br>
					<div class="row text-right">
						<span>
							<a class="like-button">Like<a>
						</span>
					    <!-- <a id="" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> likes</a> !-->
					</div>
				</div>
	        </div>
		</div>
    	<div class="row">
			<div class="col-md-4">
	              <div class="thumbnail">
				      <img src="..." alt="...">
				      <div class="caption">
				        <h5>{{Auth::check() ? Auth::user()->name : "Jon Jackson"}}</h5>
				        <p>...</p>
				      </div>s
			    </div>
			</div>
			<div class="col-md-8">
				<p>Pernah terlintas, bagaimana susuh dan sulitna untuk berangkat ke sekolah? mungkin sebagian anak dan orang dewasa tidak pernah membayangkan, apalagi mengalaminya. Tetapi yakinlah , sebagian beasar anak Indonesia masih banyak yang mengalami. Yaitu bagaimana sulitnya untuk berangkat menuiju ke tempat mereka belajar, yaitu sekolah.</p>
			</div>
		</div>
		<div class="row" style="background-color: #ddd">
			<div class="text-center">
				<h6>Suka dengan foto diatas?</h6>
				<strong>SHARE KE TEMANMU</strong>
			</div>
		</div>
	</div>

@endsection

@section('footer')
	@include('_partial/footer')
@endsection

@section('bottom')
	<script>
		$(function() {
		    $('.like-button').click(function(){
		    	console.log('haha');


		        var obj = $(this);
		        if( obj.data('liked') ){
			    	$.ajax({
			    		type: "POST",
			    		url: '/unlike/photo',
			    		data: {
			    			photo_id: 3
			    		},
			    		success: function(data) {
			    			console.log(data);
			    		}
			    	})

		            obj.data('liked', false);
		            obj.html('Like');
		        }
		        else{
			    	$.ajax({
			    		type: "POST",
			    		url: '/like/photo',
			    		data: {
			    			photo_id: 3
			    		},
			    		success: function(data) {
			    			console.log(data);
			    		}
			    	})
		            obj.data('liked', true);
		            obj.html('Unlike');
		        }
		    });
		});
	</script>
@endsection