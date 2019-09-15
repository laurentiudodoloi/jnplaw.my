<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Admin | Joseph & Partners</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">

        {{-- CSS --}}
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin-general.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

        <script src="https://use.fontawesome.com/d2154184d1.js"></script>

        @yield('head')

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

        <div id="vue-app" style="height: 100%;">
            <admin-dashboard></admin-dashboard>
        </div>

{{--        @include('inc.admin.sidebar')--}}

{{--        <div class="content-wrap">--}}
{{--            @include('inc.admin.navbar')--}}

{{--            <div class="content">--}}
{{--                @yield('admin')--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <script src="{{ asset('js/bootstrap.js') }}"></script>--}}

{{--        @yield('scripts')--}}

        <script src="{{ asset('js/vue-admin-app.js') }}"></script>
    </body>
</html>
