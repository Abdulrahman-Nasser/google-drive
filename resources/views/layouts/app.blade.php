<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&family=Roboto&display=swap" rel="stylesheet">

    {{-- bootstrap icons --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">

    {{-- wow --}}
    <link rel="stylesheet" href="{{ asset('vendor/wow/animate.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand animate__animated animate__rubberBand" href="{{ url('/home') }}">
                    Google Drive
                </a>
                <button class="navbar-toggler btn_toggle" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon" style="color: white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @auth()
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link animate__animated animate__bounceInDown"
                                    href="{{ route('drive.create') }}">Upload File</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link animate__animated animate__bounceInUp"
                                    href="{{ route('drive.index') }}">My Files</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link animate__animated animate__bounceInDown"
                                    href="{{ route('drives.shared') }}">Shared Files</a>
                            </li>
                            @if (Auth::user()->rule == 1)
                                <li class="nav-item">
                                    <a class="nav-link animate__animated animate__bounceInDown"
                                        href="{{ route('drive.allFile') }}">All Files</a>
                                </li>
                            @endif
                        </ul>
                    @endauth
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link animate__animated animate__rubberBand"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link animate__animated animate__rubberBand"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                           
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>


    {{-- jQuery --}}
    <script src="{{ asset('vendor/jQuery/jquery-3.6.1.min.js') }}"></script>
    {{-- wow Animation --}}
    <script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
    {{-- bootstrap  js --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- main js --}}
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
