<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
        @vite('resources/css/simulasi.css')
</head>

<body>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Mendeklarasikan variabel global untuk digunakan di file JS
        window.questionIds = @json($questions->pluck('id')->toArray());
        window.username = '{{ auth()->user()->username }}'; // Mengambil username dari Laravel
        window.csrfToken = '{{ csrf_token() }}'; // Token CSRF untuk keamanan
    </script>
    @vite('resources/js/simulasi.js')
</body>

</html>
