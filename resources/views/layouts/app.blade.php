<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        {{-- CSS --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <style>
            html, body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
            }
        </style>

    </head>

    <body>

        @yield('content')

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/menu.js') }}"></script>
    </body>
</html>