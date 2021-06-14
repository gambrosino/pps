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
                                <a class="navbar-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="ml-6">
                                    <a class="navbar-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a class="navbar-link mx-3" href="{{ route('home')}}" role="button">
                                    Página Principal <span class="caret"></span>
                                </a>
                            </li>
                            @if ( auth()->user()->role->name == 'admin' )
                                <li>
                                    <a class="navbar-link mx-3" href="{{ route('settings.index') }}" role="button">
                                        Configuraciones <span class="caret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a class="navbar-link mx-3" href="{{ route('users.index') }}" role="button">
                                        Usuarios <span class="caret"></span>
                                    </a>
                                </li>

                                <li>
                                    <div class="relative">
                                        <input type="checkbox" id="sortbox-solicitudes" class="hidden absolute">
                                        <label class="cursor-pointer navbar-link mx-3" for="sortbox-solicitudes" class="flex items-center space-x-1 cursor-pointer">
                                            Solicitudes
                                        </label>
                                        <div id="sortboxmenu-solicitudes" class="absolute mt-3 right-1 top-full min-w-max shadow rounded opacity-0  transition delay-75 ease-in-out z-10">
                                            <ul class="block text-right text-gray-900">
                                                <li class="sortboxmenuitem">
                                                    <a class="navbar-link mx-3" href="{{ route('solicitude.index')}}?status=pending" role="button">
                                                        Solicitudes Pendientes<span class="caret"></span>
                                                    </a>
                                                </li>
                                                <li class="sortboxmenuitem">
                                                    <a class="navbar-link mx-3" href="{{ route('solicitude.index')}}?status=accepted" role="button">
                                                        Solicitudes Aceptadas<span class="caret"></span>
                                                    </a>
                                                </li>
                                                <li class="sortboxmenuitem">
                                                    <a class="navbar-link mx-3" href="{{ route('solicitude.index')}}?status=rejected" role="button">
                                                        Solicitudes Rechazadas<span class="caret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            @if ( auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'tutor')
                                <li>
                                    <div class="relative">
                                        <input type="checkbox" id="sortbox-pps" class="hidden absolute">
                                        <label class="cursor-pointer navbar-link mx-3" for="sortbox-pps" class="flex items-center space-x-1 cursor-pointer">
                                            Practica Profesional
                                        </label>
                                        <div id="sortboxmenu-pps" class="absolute mt-3 right-1 top-full min-w-max shadow rounded opacity-0  transition delay-75 ease-in-out z-10">
                                            <ul class="block text-right text-gray-900">
                                                <li class="sortboxmenuitem">
                                                    <a class="navbar-link mx-3" href="{{ route('professional-practices.index') }}?status=active" role="button">
                                                        Practicas Activas<span class="caret"></span>
                                                    </a>
                                                </li>
                                                <li class="sortboxmenuitem">
                                                    <a class="navbar-link mx-3" href="{{ route('professional-practices.index') }}?status=in_revision" role="button">
                                                        Practicas En Revision<span class="caret"></span>
                                                    </a>
                                                </li>
                                                <li class="sortboxmenuitem">
                                                    <a class="navbar-link mx-3" href="{{ route('professional-practices.index') }}?status=completed" role="button">
                                                        Practicas Aprobadas<span class="caret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            <li>
                                <div class="relative">
                                    <input type="checkbox" id="sortbox-profile" class="hidden absolute">
                                    <label class="cursor-pointer navbar-link mx-3" for="sortbox-profile" class="flex items-center space-x-1 cursor-pointer">
                                        {{ Auth::user()->name }}
                                    </label>
                                    <div id="sortboxmenu-profile" class="absolute mt-3 right-1 top-full min-w-max shadow rounded opacity-0  transition delay-75 ease-in-out z-10">
                                        <ul class="block text-right text-gray-900">
                                            <li class="sortboxmenuitem">
                                                <a class="navbar-link mx-3" href="{{ route('users.show', ['user' => Auth::user()]) }}" role="button">
                                                    Perfil <span class="caret"></span>
                                                </a>
                                            </li>
                                            <li class="sortboxmenuitem">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button class="navbar-link mx-3" type="submit">{{ __('Cerrar Sesión') }}</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-5 h-full min-h-screen">
            <div class="container mx-auto mb-5 flex justify-start">
                @yield('backbutton')
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
