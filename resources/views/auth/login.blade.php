@extends('layouts.app')

@section('content')
<div class="container-fluid" id="login">
	<div class="container">
		 <div class="row justify-content-center">
			  <div class="col">
					<img src="{{ asset('images/login_PP-logo.png') }}" alt="PassionPuro Login" class="login-logo">
							  <form method="POST" action="{{ route('login') }}" id="login-form">
									@csrf

									<div class="form-group row"> 

										 <div class="col-12">
											  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail') }}">

											  @error('email')
													<span class="invalid-feedback" role="alert">
														 <strong>{{ $message }}</strong>
													</span>
											  @enderror
										 </div>
									</div>

									<div class="form-group row"> 

										 <div class="col-12">
											 <div class="pass-box">
											  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
												 <span toggle="#password" class="show-hide-pass"></span>
											</div>

											  @error('password')
													<span class="invalid-feedback" role="alert">
														 <strong>{{ $message }}</strong>
													</span>
											  @enderror
										 </div>
									</div>

									<!--<div class="form-group row">
										 <div class="col-md-6 offset-md-4">
											  <div class="form-check">
													<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

													<label class="form-check-label" for="remember">
														 {{ __('Remember Me') }}
													</label>
											  </div>
										 </div>
									</div>-->

									<div class="form-group row mb-0">
										 <div class="col-12">
											  <button type="submit" class="btn orange w-100">
													{{ __('Login') }}
											  </button>

											  @if (Route::has('password.request'))
													<a class="grey-link mt-3 text-center" href="{{ route('password.request') }}">
														 {{ __('Forgot Your Password?') }}
													</a>
											  @endif
										 </div>
									</div>
							  </form>
			  </div>
		 </div>
	</div>
</div>
@endsection
