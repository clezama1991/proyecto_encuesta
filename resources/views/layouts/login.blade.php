<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login | Encuesta</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('img/ucin_favicon.png') }}"/>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>
<div class="d-flex justify-content-center align-items-center h-100">
    @yield('content')
</div>
@yield('scripts')
</html>
