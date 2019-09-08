<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
        <div id="gallery-target"></div>
        <div class="video-sliders" style="display: none;">
            <div class="video-slider">{{ asset('videos/street.jpg') }}</div>
            <div class="video-slider">{{ asset('videos/landscape-0.jpg') }}</div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
