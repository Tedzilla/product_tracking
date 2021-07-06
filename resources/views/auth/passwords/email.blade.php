@extends('layouts.app')

@section('content')

<div class="container-fluid" id="email-pass">
	@if (\Session::has('success'))
	<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="showModalOnLoad">
	  <div class="modal-dialog" role="document">
		 <div class="modal-content text-center p-3">
			<div class="modal-body">
				<img src="/public/images/checked.svg" alt="success">
				<p class="m-blue-color">Your changes have been saved successfully!</p>
			</div>
		 </div>
	  </div>
	</div>
	@endif
	<div class="container">
		 <div class="row justify-content-center">
			  <div class="col">
					<img src="{{ asset('images/login_PP-logo.png') }}" alt="PassionPuro Login" class="login-logo"> 
				  
                    <form method="POST" action="{{ route('password.email') }}" id="email-pass-form">
                        @csrf

                        <div class="form-group row">

                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn orange w-100">
                                    {{ __('Send Password Reset Link') }}
                                </button>
										 
										 <a class="grey-link mt-3 text-center" href="{{ route('login') }}">
														 {{ __('Go to login') }}
													</a>
                            </div>
                        </div>
                    </form>
			  </div>
		 </div>
	</div>
</div> 
@endsection
