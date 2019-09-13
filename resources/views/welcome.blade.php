@extends('layouts.app')

@section('content')

    <div style="display: flex;">
        <div style="padding: 12px 0; display: flex; justify-content: center; width: 100px; background: red;">
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

@endsection

@section('scripts')
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
@endsection
