<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/profile/img/logo_jatim.png') }}" rel="icon">
    <link href="{{ asset('assets/profile/img/logo_jatim.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/profile/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/profile/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/profile/css/style.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
    <!-- Content -->
    @yield('content')

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/profile/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/profile/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/profile/js/main.js') }}"></script>
</body>
</html>