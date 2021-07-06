<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'PasionPuro') }}</title>

<!-- Scripts --> 
<script src="{{ asset('js/app.js') }}" defer></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script> 

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
   <div class="container-fluid" id="main-nav">
      <div class="container d-flex justify-content-between">
         <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('products') }}">Products </a> </li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('add_events') }}">Events</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('events') }}">Event Log</a> </li>
               </ul>
            </div>
         </nav>
         <div class="align-self-center d-flex flex-grow-1 justify-content-end">
            <div class="dropdown align-self-center mr-3">
               <div class="dropdown-toggle" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{ asset('images/icon_user.svg') }}" alt="User menu" class="login-logo"> </div>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuUser"> @guest <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a> @if (Route::has('register')) <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a> @endif
                  @else
                  <div class="menu-user-data mb-4">
                     <div id="user-init"></div>
                     <div class="ml-1 align-self-center">
                        <div id="user-name">{{ Auth::user()->name }} </div>
                        <div class="small-mail">{{ Auth::user()->email }}</div>
                     </div>
                  </div>
                  <a class="dropdown-item" href="{{ route('admin.users.index') }}">Users</a> <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
                  @endguest </div>
            </div>
            <div class="align-self-center"> <img src="{{ asset('images/header_PP-logo.png') }}" alt="{{ config('app.name', 'PasionPuro') }}" class="login-logo"> </div>
         </div>
      </div>
   </div>
   <main class="py-4"> @include('partials.alerts')
      @yield('content') </main>
</div>
</body>
</html>
