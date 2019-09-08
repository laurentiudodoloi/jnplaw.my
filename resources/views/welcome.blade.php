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
        <div id="gallery-target"></div>
        <div class="video-sliders" style="display: none;">
            <div class="video-slider">{{ asset('videos/street.jpg') }}</div>
            <div class="video-slider">{{ asset('videos/landscape-0.jpg') }}</div>
        </div>

        <div class="content-wrapper">

            <nav class="navigation">
                <div class="brand">
                    <img src="{{ asset('images/joseph&partners.png') }}" width="209" alt="" class="logo">
                </div>

                <a href="#" class="menu-button w-inline-block overlay-hamburger">
                    <div class="overlay-hamburger__line overlay-hamburger__line--01">
                        <div class="overlay-hamburger__line-in overlay-hamburger__line-in--01 overlay-hamburger__line-in--demo-3"></div>
                    </div>
                    <div class="overlay-hamburger__line overlay-hamburger__line--02">
                        <div class="overlay-hamburger__line-in overlay-hamburger__line-in--02 overlay-hamburger__line-in--demo-3"></div>
                    </div>
                    <div class="overlay-hamburger__line overlay-hamburger__line--03">
                        <div class="overlay-hamburger__line-in overlay-hamburger__line-in--03 overlay-hamburger__line-in--demo-3"></div>
                    </div>
                    <div class="overlay-hamburger__line overlay-hamburger__line--cross01">
                        <div class="overlay-hamburger__line-in overlay-hamburger__line-in--cross01 overlay-hamburger__line-in--demo-3"></div>
                    </div>
                    <div class="overlay-hamburger__line overlay-hamburger__line--cross02">
                        <div class="overlay-hamburger__line-in overlay-hamburger__line-in--cross02 overlay-hamburger__line-in--demo-3"></div>
                    </div>
                </a>

                <div class="global-menu">
                    <div class="global-menu__wrap">
                        <a class="global-menu__item global-menu__item--demo-3 w--current" href="#about">About Us</a>
                        <a class="global-menu__item global-menu__item--demo-3" href="#whatwedo">What We Do</a>
                        <a class="global-menu__item global-menu__item--demo-3" href="#people">Our People</a>
                        <a class="global-menu__item global-menu__item--demo-3" href="#knowledge">Our Knowledge</a>
                        <a class="global-menu__item global-menu__item--demo-3" href="#news">News</a>
                        <a class="global-menu__item global-menu__item--demo-3" href="#events">Events</a>
                        <a class="global-menu__item global-menu__item--demo-3" href="#contact">Contact Us</a>
                    </div>
                    <div class="global-menu-copyright">Copyright © Mr.X Sport Recovery Drink</div>
                </div>

                <svg class="shape-overlays" viewbox="0 0 25 75" preserveaspectratio="none">
                    <path class="shape-overlays__path" d="M 0 100 C 50 100 50 100 100 100 V 100 H 0"></path>
                    <path class="shape-overlays__path" d="M 0 100 C 50 100 50 100 100 100 V 100 H 0"></path>
                    <path class="shape-overlays__path" d="M 0 100 C 50 100 50 100 100 100 V 100 H 0"></path>
                </svg>
            </nav>

            <div class="container">
                <div class="content">
                    <div class="item-left">
                        <div class="text-block video-heading-text">Video text 1</div>
                        <h1 class="heading-2 video-title">‍Video title 1</h1>
                        <p class="paragraph video-description">Video description 1</p>
                        <p class="more-info">information</p>
                    </div>

                    <div class="item-right">
                        <a href="#" class="button play-btn w-button">
                            Play >
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="footer-left">
                    <div>#000</div>
                    <div class="text-footer">About Us</div>
                </div>
                <div class="footer-right">
                    <div>#002</div>
                    <div class="text-footer">What We Do</div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/menu.js') }}"></script>
    </body>
</html>
