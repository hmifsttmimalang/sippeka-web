<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('hasil_simulasi')
    @yield('terkirim')
    @yield('sudah_dikerjakan')
</head>
<body>
    @yield('content')
</body>
</html>
