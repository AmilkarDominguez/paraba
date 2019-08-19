<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Paraba</title>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">


  <!-- Styles  tadatable -->

  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">

  <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">

  <!-- Custom Style by Amilkar -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-gradient-info">
    <main class="p-2">
        @yield('content')
    </main>
  <script src="{{ asset('js/assets/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('js/assets/popper.min.js') }}"></script>
  <!--Admin-->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.js') }}"></script>
  <!--Alert-->
  <script src="{{ asset('js/assets/toastr.js') }}"></script>
</body>
</html>
