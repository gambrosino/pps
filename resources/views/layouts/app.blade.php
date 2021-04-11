<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-screen text-gray-800 font-sans antialiased">
    <div id="app" class=" bg-gray-800">
        <nav class="bg-white shadow">
            <div class="container nav-container">
                <div>
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" width="40" alt="dummy logo">
                    </a>
                </div>
                <div>
                    <!-- Right Side Of Navbar -->
                    <ul class="flex">
                        <!-- Authentication Links -->
                        @guest
                            <li>
                                <a class="navbar-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="ml-6">
                                    <a class="navbar-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if ( auth()->user()->role->name == 'admin' )
                                <li>
                                    <a id="userList" class="navbar-link" href="{{ route('users.index')}}" role="button">
                                        Usuarios <span class="caret"></span>
                                    </a>
                                </li>
                            @endif
                            <li class="ml-6">
                                <a id="navbarDropdown" class="navbar-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                            </li>
                            <li class="ml-6">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="navbar-link" type="submit">{{ __('Logout') }}</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-5 h-full min-h-screen">
            <div class="container mx-auto mb-5 flex justify-start">
                @if (Request::url() != route('home') && Request::url() != route('login') && Request::url() != route('register'))
                        @include('partials.back', ['route' => url()->previous()])
                @endif
                @if (session('message'))
                    <div class="bg-teal-100 border-t-4 text-center border-teal-500 rounded-b text-teal-900 px-4 py-2 shadow-md ml-3 inline-block w-full" role="alert">
                        {{session('message')}}
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
        <footer class="bg-white shadow">
            <div class="container nav-container">
                <div>
                    2021 designed by Pollux
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
