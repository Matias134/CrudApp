<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href={{ asset('favicon/libro.png') }} type="image/x-icon">
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    @yield('css')
    <title>Crud app | @yield('title')</title>
</head>
<body>
    @include('layouts.header')
    @include('layouts.nav')
    <div class="container mb-5">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('js')
</body>
</html>