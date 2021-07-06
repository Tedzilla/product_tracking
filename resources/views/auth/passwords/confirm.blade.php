@extends('layouts.app')

@section('content')
<div class="container-fluid" id="reset-pass">
	<div class="container">
		 <div class="row justify-content-center">
			  <div class="col">
					<img src="{{ asset('images/login_PP-logo.png') }}" alt="PassionPuro Login" class="login-logo">
                    <form method="POST" action="{{ route('password.confirm') }}" id="password-reset">
                        @csrf

                        <div class="form-group row"> 

                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
									<div class="col-12">
										<div class="form-group">  
											  <input placeholder="{{ __('Confirm Password') }}" id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"> 
										</div>
									</div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn orange w-100">
                                    {{ __('Confirm Password') }}
                                </button>
										 <a class="grey-link mt-3 text-center" href="{{ route('login') }}">
														 {{ __('Go to login') }}
													</a>

                                <!--@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif-->
                            </div>
                        </div>
                    </form>
			  </div>
		 </div>
	</div>
</div> 
@endsection
