<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>
        body {
            background-color: #F9F9FF;
            color: #444444;
        }

        .question-container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .option-btn {
            display: inline-block;
            margin-right: 10px;
        }

        .option-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .timer {
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .timer i {
            margin-right: 8px;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .question-nav button {
            margin-right: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
