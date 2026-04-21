@extends('layout.login.app')

@section('title', 'Signup | JMS')

@section('content')
	<div class="main-div min-vh-100 d-flex" style="background-color: #292929;">
		<div class="container d-flex justify-content-between align-items-center">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="left  d-flex justify-content-center">
						<img src="{{ asset('/images/jms.png') }}" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="right  d-flex justify-content-center">
						<div class="form bg-white rounded-5 py-2 px-5" style="width: 660px; height: fit-content;">
						<div id="error-message-container"></div>
							<h3 class="mb-4 mt-3  text-center fs-1">Sign Up</h3>
							<form id="signup"> 
							@csrf 
							<label for="name" class="fs-6">Name</label>
								<div class="d-flex justify-content-between gap-4 mt-1">
									<div><input type="text" name="first_name" id="first_name" placeholder=" First Name" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50" style="padding: 15px;">
									</div><div>	<input type="text" name="last_name" id="last_name" placeholder=" Last Name" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50" style="padding: 15px;">
									</div></div>
								<div class="d-flex justify-content-between gap-4 mb-4 mt-4">
									<div>
										<label for="email" class="fs-6">Email Address</label>
										<input   name="email" id="email" placeholder="Email" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50 mt-2" style="padding: 15px;">
									</div>
									<div>
										<label for="number" class=" fs-6">Mobile No.</label>
										<input type="text" name="mobile_no" id="mobile_no" placeholder="Mobile No." class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50" style="padding: 15px;">
									</div>
								</div>
								<div class="d-flex justify-content-between gap-4">
									<div>
										<label for="password" class="fs-6">Password</label>
										<input type="password" name="password" id="password" placeholder="Password" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50" style="padding: 15px;">
									</div>
									<div>
										<label for="c-password" class="fs-6">Confirm Password</label>
										<input type="password" name="c_password" id="c_password" placeholder="Confirm Password" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50" style="padding: 15px;">
									</div>
								</div>
								<button class="formbtn border-0 rounded-pill p-3 fw-medium fs-3 mt-5 mb-3 text-dark" type="submit">Sign up</button>
							</form>
							<!-- <div class="text-center mt-3 border-bottom "><span class="fw-bold">Or</span></div><div class="login d-flex gap-4 text-center justify-content-center mt-4"><div class=" google border border-black border-1 rounded-4 py-2 px-4" style="width:fit-content; padding:12px 40px"><a href="#" class="text-decoration-none gap-3 d-flex text-body-emphasis"><img src="/images/google.svg" alt=""  style="width: 20px;"><span class="mb-0 fw-semibold fs-6" style="width: fit-content;">Sign in with Google</span></a></div><div class="facebook border border-black border-1 rounded-4 py-2 px-4"  style="width: fit-content; padding: 8px 40px;"><a href="#" class="text-decoration-none gap-3 d-flex text-body-emphasis"><img src="/images/facebook.svg"  alt="facebook" style="width: 12px;"><span class="mb-0 fw-semibold fs-6" style="width: fit-content;">Sign in with Facebook</span></a></div></div> -->
							<p class="mt-3 text-center fs-6">Already have an account? <a href="{{route('login')}}" class="text-decoration-none">Login</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page-footer-script')
<meta name="csrf-token" content="{{ csrf_token() }}">
	<script>
		$(document).ready(function() {
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
			$('#signup').submit(function(e) {
				e.preventDefault();

				var formData = new FormData(this);

				$('.text-danger').remove(); 
				$('#error-message-container').empty();
				showLoader();
				$.ajax({
					type: 'POST',
					url: "{{ route('signsave') }}",
					data: formData,
					processData: false,
					contentType: false,
					success: function(response) {
						// console.log(response); 
						hideLoader();
						$('#signup')[0].reset();
						window.location.href = "{{route('login')}}";
					},
				 error: function(xhr, status, error) {
						hideLoader();
						var response = xhr.responseJSON;
						if (response && response.errors) {
							$.each(response.errors, function(key, value) {
								$('#' + key).after('<div class="text-danger">' + value[0] + '</div>');
							});
						}

						if (response && response.message) {
							$('#error-message-container').html('<div class="alert alert-danger">' + response.message + '</div>');
						}
					}
				});
			});
		});
</script>
	
@endsection


