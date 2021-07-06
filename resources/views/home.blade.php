@extends('layouts.app')

@section('content')
<div class="container" id="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::check())
                        {{ __('You are logged in!') }}
                        <a href="{{ url('/logout') }}"> logout </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
