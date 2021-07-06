@extends('layouts.app')

@section('content')

<div class="container-fluid" id="reset-pass">
	<div class="container">
		 <div class="row justify-content-center">
			  <div class="col">
					<img src="{{ asset('images/login_PP-logo.png') }}" alt="PassionPuro Login" class="login-logo"> 
				  
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn orange w-100">
                                    {{ __('Reset Password') }}
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
