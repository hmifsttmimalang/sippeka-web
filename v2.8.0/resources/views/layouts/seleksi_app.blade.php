<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" rel="icon">
    <link href="{{ asset('assets/user/img/silastri/logo_jatim.png') }}" rel="apple-touch-icon">
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/seleksi.css') }}">
    
    <style>
        .swal2-button-space .swal2-confirm {
            margin-left: 10px;
            /* Tambahkan jarak antara tombol cancel dan confirm */
        }

        .swal2-button-space .swal2-cancel {
            margin-right: 10px;
            /* Tambahkan jarak antara confirm dan cancel */
        }
    </style>
</head>
<body>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Mendeklarasikan variabel global untuk digunakan di file JS
        window.questionIds = @json($questions->pluck('id')->toArray());
        window.username = '{{ auth()->user()->username }}'; // Mengambil username dari Laravel
        window.csrfToken = '{{ csrf_token() }}'; // Token CSRF untuk keamanan
        window.remainingTime = {{ $remainingSeconds }};
    </script>
    <script src="{{ asset('assets/js/seleksi.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
