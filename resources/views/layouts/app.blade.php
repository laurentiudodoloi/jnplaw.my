<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Joseph & Partners</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">

        {{-- CSS --}}
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

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

        <div class="menu-wrap">
            <div class="menu">
                <div style="z-index: 100000;" class="hamburger-menu-block hamburger-menu hamburger-menu-click">
                    <span class="line line-0"></span>
                    <span class="line line-1"></span>
                    <span class="hamburger-menu-text">MENU</span>
                </div>
            </div>

            <svg class="shape-overlays" viewbox="0 0 1 90" preserveaspectratio="none">
                <path class="shape-overlays__path" d="M 0 100 C 100 100 100 100 100 100 V 100 H 0"></path>
                <path class="shape-overlays__path" d="M 0 100 C 100 100 100 100 100 100 V 100 H 0"></path>
                <path class="shape-overlays__path" d="M 0 100 C 100 100 100 100 100 100 V 100 H 0"></path>
            </svg>
        </div>

        <div class="global-menu">
            <div class="global-menu__wrap">
                <a class="global-menu__item global-menu__item--demo-3 w--current" href="{{ route('about-us') }}">About Us</a>
                <a class="global-menu__item global-menu__item--demo-3" href="{{ route('videos') }}">What We Do</a>
                <a class="global-menu__item global-menu__item--demo-3" href="#people">Our People</a>
                <a class="global-menu__item global-menu__item--demo-3" href="#knowledge">Our Knowledge</a>
                <a class="global-menu__item global-menu__item--demo-3" href="#news">News</a>
                <a class="global-menu__item global-menu__item--demo-3" href="#events">Events</a>
                <a class="global-menu__item global-menu__item--demo-3" href="#contact">Contact Us</a>
            </div>
        </div>

        @yield('content')

        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/menu.js') }}"></script>

        <script>
            var menu = document.querySelector('.hamburger-menu');

            function toggleClass (el, classname) {
                if (!el.classList.contains(classname)) {
                    el.classList.add(classname);
                } else {
                    el.classList.remove(classname);
                }
            }

            menu.addEventListener('click', function (evt) {
                if (!menu.classList.contains('hamburger-menu-closed')) {
                    menu.classList.add('hamburger-menu-closed');
                    menu.querySelector('.hamburger-menu-text').classList.add('hamburger-menu-text-hidden');

                    menu.querySelector('.hamburger-menu-text').classList.remove('show-text');

                    menu.querySelector('.line-0').classList.remove('line-0-bounce');
                    menu.querySelector('.line-1').classList.remove('line-1-bounce');
                } else {
                    menu.classList.remove('hamburger-menu-closed');
                    menu.querySelector('.hamburger-menu-text').classList.remove('hamburger-menu-text-hidden');

                    menu.querySelector('.line-0').classList.add('line-0-bounce');
                    menu.querySelector('.line-1').classList.add('line-1-bounce');

                    menu.querySelector('.hamburger-menu-text').classList.add('show-text');
                }
            });
        </script>

        @yield('scripts')
    </body>
</html>
