@extends('layout.login.app')

@section('title', 'Forgot Password | JMS')

@section('content')
	<div class="main-div d-flex min-vh-100" style="background-color: #292929;">
		<div class="container d-flex justify-content-between align-items-center">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="left  d-flex justify-content-center">
						<img src="{{asset('images/jms.png')}}" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="right d-flex justify-content-center">
						<div class="form bg-white rounded-5 p-5" style="width: 520px; height:fix-content;">
						<form id="forgetpassword">
						@csrf
							<h3 class="mb-4 mt-3 text-center fs-1" style="color: #4E4D4D;">Forgot Password</h3>
							<p class="text-center fs-5 mb-4">Enter your email and We'll send you a link to reset your password</p>
							<div class="mb-3 d-flex flex-column">
								<label for="email" class="fs-5 mt-5 fw-semibold">Email Address</label>
								<input name="email" id="email" placeholder="Enter your Email" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50 mt-2" style="padding: 15px;">
							</div>
							<button class="formbtn border-0 rounded-pill p-3 fw-medium fs-3 mt-5 mb-3 text-dark" type="submit">Reset</button>
							<a href="{{route('login')}}" class="align-center d-flex justify-content-center text-decoration-none mt-3">
								<div style="width: 15px;" class="me-1 d-flex align-items-center">
									<img src="{{ asset('images/left.png') }}" alt="">
								</div> Back to login
							</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
@endsection

@section('page-footer-script')
	<script>
		$(document).ready(function() {
			$('#forgetpassword').submit(function(e) {
				e.preventDefault();

				var formData = new FormData(this);

				$('.text-danger').remove();

				$.ajax({	
					type: 'POST',
					url: "{{ route('sendmail') }}",
					data: formData,
					processData: false,
					contentType: false,
					success: function(response) {
						console.log(response);
					},
					error: function(xhr, status, error) {
						  // console.log('XHR:', xhr, 'Status:', status, 'Error:', error);
						var errors = JSON.parse(xhr.responseText).errors;
						$.each(errors, function(key, value) {
							$('#' + key).after('<div class="text-danger">' + value[0] + '</div>');
						});
					 }
				});
			});
			var successMessage = $('#successMessage');
				if (successMessage.length > 0) {
						successMessage.fadeIn();
						setTimeout(function() {
						successMessage.fadeOut();
					}, 3000); 
				}
		});
	</script>
	
@endsection


