<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Videosite') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body class=" bg-light">
    <div id="app">
        <nav style="position: fixed; z-index: 5;"
            class="w-100 navbar navbar-expand-md navbar-light bg-dark shadow-sm rounded-0 d-flex">
            <div class="container-lg d-flex justify-content-between align-items-center">
                <div class="align-self-start">
                    <a class="navbar-brand text-white" href="{{ url('/') }}">
                        {{ config('app.name', 'Videosite') }}
                    </a>
                </div>
                <div class="">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else

                                @if (Auth::user()->hasRole('admin'))
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item text-dark" href="{{ route('logout') }}">
                                                {{ __('Logout') }}
                                            </a>
                                            <a class="dropdown-item text-dark" href="{{ route('all') }}">
                                                {{ __('Todos') }}
                                            </a>
                                            <a class="dropdown-item text-dark" href="{{ route('edit') }}">
                                                {{ __('Administrar') }}
                                            </a>
                                        </div>
                                    </li>
                                @endif

                                @if (Auth::user()->hasRole('user') || Auth::user()->hasRole('editor'))
                                        <li class="nav-item mr-4">
                                            <a class="nav-link text-white" href="{{ route('all') }}">{{ __('Videos') }}</a>
                                        </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{route('profile')}}">
                                            {{ __('Perfil') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('store') }}">
                                            {{ __('Nuevo Video') }}
                                        </a>


                                    </div>
                                </li>
                                @endif

                            @endguest

                            @auth

                                <li class="nav-item ml-4">
                                    <form class="nav-link" method="POST" action="/logout">
                                        @csrf
                                        <button class="text-dark btn btn-light">Logout</button>
                                    </form>
                                </li>
                            @endauth


                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div style="margin-top: 75px;">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
