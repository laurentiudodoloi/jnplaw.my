<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">
        <script src="https://use.fontawesome.com/d2154184d1.js"></script>

        {{-- Owl Carousel --}}
        <link href="{{ asset('owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">

        {{-- CSS --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
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
        <script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>
        {{--<script src="{{ asset('js/menu.js') }}"></script>--}}

        <script>
            $(document).ready(function(){
                $('.owl-carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    nav:true,
                    navText : ['<span>&leftarrow;</span>','<span>&rightarrow;</span>'],
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,
                            autoplay:false,
                            autoplayTimeout:5000,
                            autoplayHoverPause:false
                        },
                        768:{
                            items:2
                        }
                    }
                })
            });
        </script>
    </body>
</html>
