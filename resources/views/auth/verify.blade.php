@extends('layouts.app')

@section('content')
<div class="container-fluid" id="verify">
	<div class="container">
		 <div class="row justify-content-center">
			  <div class="col">
					<img src="{{ asset('images/login_PP-logo.png') }}" alt="PassionPuro Login" class="login-logo">
				  		@if (session('resent'))
                  	<p class="text-center">{{ __('A fresh verification link has been sent to your email address.') }}</p>
                	@endif
				  
				  		  <p class="text-center mt-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                    <p class="text-center">{{ __('If you did not receive the email') }}</p>
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn orange w-100">{{ __('click here to request another') }}</button>
							  <a class="grey-link mt-3 text-center" href="{{ route('login') }}">
														 {{ __('Go to login') }}
													</a>
                    </form>
			  </div>
		 </div>
	</div>
</div>
@endsection
