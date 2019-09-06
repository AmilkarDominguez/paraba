<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Paraba</title>
 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/material/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/material/style.css') }}">
    <meta name="theme-color" content="#00645A" />
</head>

<body class="grey lighten-3">
    <header>
        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a class="brand-logo center-align">@yield('title')</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a><i class="fas fa-bars"></i></a></li>
                </ul>
            </div>
            <div class="nav-content">

            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li>
                <div class="user-view">
                    <div class="background teal">
                        <!--<img src="/images/Presenters/3.png">-->
                    </div>
                    <a href="#user"><img class="circle" src="/images/logo.jpg"></a>
                    <a href="#name"><span class="white-text name">Paraba</span></a>
                    <a href="#email"><span class="white-text email">Paraba</span></a>
                </div>
            </li>
            <li><a href="{{ route('screen_transports') }}"><i class="teal-text fas fa-bus"></i>Transporte</a></li>
            <li><div class="divider"></div></li>
            <li><a href="{{ route('screen_locations') }}"><i class="teal-text fas fa-location-arrow"></i>Sitios</a></li>
            <li><div class="divider"></div></li>
            <li><a href="{{ route('screen_posts') }}"><i class="teal-text fas fa-newspaper"></i>Recomendaciones</a></li>
        </ul>
    </header>
    <main>
        <br>
        <div class="container">
            <main class="p-2">
                @yield('content')
            </main>
        </div>
    </main>
    <div class="fixed-action-btn">
        <a class="btn-floating btn teal-darken-4" onclick="location.reload();">
            <i class="fas fa-sync-alt"></i>
        </a>
    </div>

    <script src="{{ asset('js/assets/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/assets/material/materialize.js') }}"></script>
    <script src="{{ asset('js/assets/material/init.js') }}"></script>

    @yield('scripts')
</body>
</html>     