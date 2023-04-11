<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong> Your Attendance </strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                        @auth
                        @if (\Auth::user()->role == 'Admin')
                        <li class=" nav-item sr">
                            <livewire:search-users />
                        </li>
                        @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <span><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        @if (\Auth::user()->role == 'Admin')
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><b> Vos Services</b></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{url('Students')}}"> All Students </a>
                                <a class="dropdown-item" href="{{url('Teachers')}}">All Teachers</a>
                                <a class="dropdown-item" href="{{url('Filieres')}}">All Filieres</a>
                                <a class="dropdown-item" href="{{url('Modules')}}">All Modules</a>
                            </div>
                        </li>
                        @elseif(\Auth::user()->role == 'Student')
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><b> Vos Services</b></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('student_profile')}}">Profile</a>
                                <a class="dropdown-item" href="{{route('student_absence')}}">Absence</a>
                                <a class="dropdown-item" href="{{route('notifications')}}">Notifications</a>
                            </div>
                        </li>
                        @elseif (\Auth::user()->role == 'Teacher')
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><b> Vos Services</b></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('teacher.teacher_profile')}}">Profile</a>
                                <a class="dropdown-item" href="{{url('Teacher/absence')}}">Absence</a>
                            </div>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b>{{ Auth::user()->name }}</b>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>

        </main>
    </div>
    <footer class="footer text-center text-lg-start">
        <div class="brands">
            <div class="logo">
                <img src=" {{ asset('img/laravel.png') }}" alt="brand">
            </div>
            <div class="logo">
                <img src=" {{ asset('img/livewire.jpg') }} " alt="brand">
            </div>
            <div class="logo">
                <img src=" {{ asset('img/mongodb.jpg') }} " alt="brand">
            </div>
        </div>
        </div>
        <!-- Copyright -->
        <div class="text-center p-3">
            © 2023 Projet
        </div>
        <!-- Copyright -->
    </footer>
    @livewireScripts
</body>

</html>