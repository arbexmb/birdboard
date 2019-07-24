<!DOCTYPE html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-2">
                    <h1>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.svg') }}" alt="Birdboard" />
                        </a>
                    </h1>

                    <div>
                        <!-- Right Side Of Navbar -->
                        <div class="navbar-nav ml-auto relative">
                            <!-- Authentication Links -->
                            @guest
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else

                                <dropdown align="right">
                                    <template v-slot:trigger>
                                        <button class="nav-link dropdown-toggle flex items-center">
                                            <img
                                                src="{{ gravatar_url(auth()->user()->email) }}" 
                                                alt="{{ auth()->user()->name }}'s avatar" 
                                                class="avatar-picture mr-2" 
                                                style="max-width:40px;"
                                            />
                                            {{ auth()->user()->name }} <span class="caret"></span>
                                        </button>
                                    </template>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-menu-link">Logout</button>
                                    </form>
                                </dropdown>

                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
