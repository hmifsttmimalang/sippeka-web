<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/profile/img/logo_jatim.png') }}" rel="icon">
    <link href="{{ asset('assets/profile/img/logo_jatim.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/profile/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/profile/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Content -->
    @yield('content')

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/profile/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/profile/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/php-email-form/validate.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/profile/js/main.js') }}"></script>
</body>
</html>
