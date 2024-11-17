<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" rel="icon">
    <link href="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" rel="apple-touch-icon">

    @yield('hasil_simulasi')
    @yield('terkirim')
    @yield('sudah_dikerjakan')
</head>
<body>
    @yield('content')
</body>
</html>
