<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('vendor/datatable/datatables.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('vendor/datatable/buttons.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-dark bg-success flex-md-nowrap p-0 shadow">
            {{-- <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a> --}}
            <a class="navbar-brand col-md-3 col-lg-1 mr-0 px-3" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item text-white m-0 p-2 pl-3">Toner Management</li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto px-3">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        
                        {{-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif --}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    @guest
                        <div class="col-md-12 px-md-4">
                            <!-- MAIN CONTENT -->
            
                            @yield('content')
            
                            <!-- END MAIN CONTENT -->
                        </div>
                    @else
                        @include('layouts.sidebar-menu')
                        
                        <div class="col-md-9 ml-sm-auto col-lg-11 px-md-4">
                            <!-- MAIN CONTENT -->
                            <div class="container-fluid p-0">
                                @include('includes.messages.message')
                                @yield('content')
                                
                            </div>
                            
            
                            <!-- END MAIN CONTENT -->
                        </div>
                    @endguest
                    
                </div>
            </div>
            
        </main>
    </div>
    
    <script src="{{ URL::asset('vendor/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('js/custom.js') }}"></script>
    <script src="{{ URL::asset('js/datatable.js') }}"></script>
</body>
</html>
