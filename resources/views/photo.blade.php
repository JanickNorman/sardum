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
					<img class="img-responsive" src="{{$data['image']}}" alt="">
					<br>
					<div class="row text-right">
						<div>
							<span class="like">{{$data['totalLikes']}}</span>
						</div>
						<span>
							<a class="btn btn-sm btn-default like-button" data-photoid={{$data['photo_id']}}>like</a>
						</span>
					    <!-- <a id="" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> likes</a> !-->
					</div>
				</div>
	        </div>
		</div>
    	<div class="row">
			<div class="col-md-4">
	              <div class="thumbnail">
				      <img src="{{$data['avatar_uploader']}}" alt="...">
				      <div class="caption">
				        <h5>{{$data['nama_uploader']}}</h5>
				        <h6><a href="#">view all posts</a></h6>
				      </div>
			    </div>
			</div>
			<div class="col-md-8">
				<p>{{$data['deskripsi']}}</p>
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

		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

		$(function() {
		    $('.like-button').click(function(){
		        var obj = $(this);
		        console.log("HAHAA");
		        if( obj.data('liked') ){
			    	$.ajax({
			    		type: "POST",
			    		url: "/unlike/photo",
			    		data: "photo_id=" + obj.data('photoid'),
			    		success: function(data) {
			    			console.log(data);
			    			console.log(data.totalLikes);
		            		obj.data('liked', false);
		            		obj.html('Like');
			    		},
			    	})

		        } else {
			    	$.ajax({
			    		type: "POST",
			    		url: "/like/photo",
			    		data: "photo_id=" + obj.data('photoid'),
			    		success: function(data) {
			    			console.log(data);
				            obj.data('liked', true);
				            obj.html('Unlike');
			    		}
			    	})
		        }
		    });
		});
	</script>
@endsection