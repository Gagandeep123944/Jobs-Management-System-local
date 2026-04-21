@extends('layout.login.app')

@section('title', 'Login | JMS')

@section('content')
<div class="main-div min-vh-100 d-flex" style="background-color: #2a2a2a;">
    <div class="container d-flex justify-content-between align-items-center" >
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="left d-flex justify-content-center">
                    <img src="{{ asset('/images/jms.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right d-flex justify-content-center">
                    <div class="form bg-white rounded-5 p-5" style="width: 660px; height: fit-content;">
                        <h3 class="mb-5 mt-3 text-center fs-1">Login</h3>

                        <!-- Error Message Display -->
                        @if(session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif
						@if (session('success'))
							<div class="alert alert-success" id="successMessage" style="display: none;">
								{{ session('success') }}
							</div>
						@endif
                       <form id="signin">
                            @csrf
                            <div class="mb-3">
                                <label for="password" class="fs-5 fw-semibold">Password</label>
                                <input type="password" name="password" id="password" id="password" placeholder="Enter your password" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50 mt-2" style="padding: 15px;">
                            </div>
                            <div>
                                <label for="c_password" class="fs-5 fw-medium">Confirm Password</label>
                                <input type="password" name="c_password" id="c_password" placeholder="Enter your Confirm Password" class="ps-3 mb-2 mt-3 border-secondary-subtle rounded-pill border border-1 border-opacity-50" style="padding: 15px;">
                            </div>
                             
                            <button class="formbtn border-0 rounded-pill p-3 fw-medium fs-3 mt-5 mb-3" type="submit" style="color: #292929;">Update</button>
                        </form>
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
		$('#signin').submit(function(e) {
			
			e.preventDefault();

			var formData = new FormData(this);

           formData.append('email', "{{ request('email') }}");

			$('.text-danger').remove();
			showLoader();
			$.ajax({	
				type: 'POST',
				url: "{{ route('resetPassword') }}",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					// hideLoader();
					// console.log(resposne);
					$('#signin')[0].reset();
					window.location.href = "{{ route('dashboard') }}";	
										
				},
				error: function(xhr, status, error) {
					hideLoader();
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


