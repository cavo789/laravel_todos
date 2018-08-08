@extends('master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm">
     <div class="panel-heading">
				<h3 class="panel-title">Houston, we have a problem!</h3>
			</div>
			<div class="panel-body"> 
				<p>Oups... nothing here</p>				
				<a href="{{ route('todos.index') }}" class="back btn btn-sm btn-success">
					<i class="far fa-hand-point-left"></i> Back
				</a>
			</div>
    </div>
    <div class="col-sm">
     <div id="lottie" style="height:250px;" />
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/4.13.0/bodymovin.min.js" type="text/javascript"></script>
	<script>
		var animation = bodymovin.loadAnimation({
			container: document.getElementById('lottie'),
			autoplay: true,
			path: 'images/errors/error_404_data.json', // https://www.lottiefiles.com/1408-network-lost
			renderer: 'svg',
			loop: true
		})
	</script>
@endsection
