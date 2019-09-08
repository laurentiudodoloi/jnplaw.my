<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
            html, body {
                margin: 0;
                padding: 0;
            }
        </style>

    </head>
    <body>

    <div id="gallery-target"></div>
    <div class="collection-list-wrapper w-dyn-list">
        <div class="w-dyn-items w-row">
            <div class="w-dyn-item w-col w-col-2">
                <div class="slider-item">
                    <div class="video-slider"></div>
                    <div class="video-slider-heading-title"></div>
                    <div class="video-slider-title"></div>
                    <div class="video-slider-description"></div>
                </div>
            </div>
        </div>
        <div class="w-dyn-empty">
            <div class="text-block-12">No items found.</div>
        </div>
    </div>
    <div class="div-block div-block-11">
        <div data-collapse="all" data-animation="default" data-duration="500" data-easing="ease-in-circ" data-doc-height="1" data-easing2="ease-in-out-circ" class="navbar navbar-mobile w-nav">
            <nav class="div-block-8 navbar-container"><img src="{{ asset('public/images/Boon_Tan_Logo.png') }}" width="209" alt="" class="logo">
                <nav role="navigation" class="nav-menu w-nav-menu"><a href="#" class="nav-link-4 w-nav-link">Home</a><a href="#" class="nav-link-2 w-nav-link">About</a><a href="#" class="nav-link-3 w-nav-link">Contact</a></nav>
                <div class="html-embed-2 w-embed">
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
                    </svg></div>
            </nav>
        </div>
        <div class="section-3">
            <div class="container-4 w-container">
                <div class="div-block-5 content">
                    <div data-w-id="c3186f05-a776-178e-8760-68705e14ae4b" class="item-left">
                        <div class="anime-text">
                            <div class="text-block video-heading-text"></div>
                            <h1 class="heading-2 video-title">‍<em class="italic-text"></em></h1>
                            <div class="text-block-3"></div>
                            <p class="paragraph video-description"></p>
                        </div>
                    </div>
                    <div data-w-id="4a1b78be-14b3-93a6-b206-91b4b6740472" class="item-right"><a href="#" class="button play-btn w-button">Play <strong class="bold-text-2"></strong></a></div>
                </div>
            </div>
        </div>
        <div class="section-2 footer">
            <div class="div-block-6 footer-left">
                <div class="text-footer item item-left">#000</div>
                <div class="text-footer item item-left bottom-link">About Us</div>
                <div class="w-embed">
                    <style>
                        .footer-left::before {
                            content: '';
                            left: 0;
                            bottom: 0;
                            position:absolute;
                            width: 0;
                            height: 0;
                            border-bottom: 6px solid #fff;
                            border-left: 20px solid transparent;
                        }
                    </style>
                </div>
            </div>
            <div class="text-footer item footer-right">
                <div class="text-footer item item-right">#002</div>
                <div class="text-footer item item-right bottom-link">What We Do</div>
                <div data-w-id="c269401d-acea-0cd9-c50a-d5c0effe20a8" style="opacity:0" class="w-embed">
                    <style>
                        .footer-right::after {
                            content: '';
                            right: 0;
                            bottom: 0;
                            position:absolute;
                            width: 0;
                            height: 0;
                            border-bottom: 6px solid #fff;
                            border-right: 20px solid transparent;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/webflow-js/webflow.js') }}" type="text/javascript"></script>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
    <script>
        /** easing */
        const ease = {
            exponentialIn: (t) => {
                return t == 0.0 ? t : Math.pow(2.0, 10.0 * (t - 1.0));
            },
            exponentialOut: (t) => {
                return t == 1.0 ? t : 1.0 - Math.pow(2.0, -10.0 * t);
            },
            exponentialInOut: (t) => {
                return t == 0.0 || t == 1.0
                    ? t
                    : t < 0.5
                        ? +0.5 * Math.pow(2.0, (20.0 * t) - 10.0)
                        : -0.5 * Math.pow(2.0, 10.0 - (t * 20.0)) + 1.0;
            },
            sineOut: (t) => {
                const HALF_PI = 1.5707963267948966;
                return Math.sin(t * HALF_PI);
            },
            circularInOut: (t) => {
                return t < 0.5
                return t * t * t;
            },
            cubicOut: (t) => {
                const f = t - 1.0;
                return f * f * f + 1.0;
            },
            cubicInOut: (t) => {
                return t < 0.5
                    ? 4.0 * t * t * t
                    : 0.5 * Math.pow(2.0 * t - 2.0, 3.0) + 1.0;
            },
            quadraticOut: (t) => {
                return -t * (t - 2.0);
            },
            quarticOut: (t) => {
                return Math.pow(t - 1.0, 3.0) * (1.0 - t) + 1.0;
            },
        }
        /** menu */
        class ShapeOverlays {
            constructor(elm) {
                this.elm = elm;
                this.path = elm.querySelectorAll('path');
                this.numPoints = 2;
                this.duration = 600;
                this.delayPointsArray = [];
                this.delayPointsMax = 0;
                this.delayPerPath = 200;
                this.timeStart = Date.now();
                this.isOpened = false;
                this.isAnimating = false;
            }
            toggle() {
                this.isAnimating = true;
                for (var i = 0; i < this.numPoints; i++) {
                    this.delayPointsArray[i] = 0;
                }
                if (this.isOpened === false) {
                    this.open();
                } else {
                    this.close();
                }
            }
            open() {
                this.isOpened = true;
                this.elm.classList.add('is-opened');
                this.timeStart = Date.now();
                this.renderLoop();
            }
            close() {
                this.isOpened = false;
                this.elm.classList.remove('is-opened');
                this.timeStart = Date.now();
                this.renderLoop();
            }
            updatePath(time) {
                const points = [];
                for (var i = 0; i < this.numPoints; i++) {
                    const thisEase = this.isOpened ?
                        (i == 1) ? ease.cubicOut : ease.cubicInOut:
                        (i == 1) ? ease.cubicInOut : ease.cubicOut;
                    points[i] = thisEase(Math.min(Math.max(time - this.delayPointsArray[i], 0) / this.duration, 1)) * 100
                }
                let str = '';
                str += (this.isOpened) ? `M 0 0 V ${points[0]} ` : `M 0 ${points[0]} `;
                for (var i = 0; i < this.numPoints - 1; i++) {
                    const p = (i + 1) / (this.numPoints - 1) * 100;
                    const cp = p - (1 / (this.numPoints - 1) * 100) / 2;
                    str += `C ${cp} ${points[i]} ${cp} ${points[i + 1]} ${p} ${points[i + 1]} `;
                }
                str += (this.isOpened) ? `V 0 H 0` : `V 100 H 0`;
                return str;
            }
            render() {
                if (this.isOpened) {
                    for (var i = 0; i < this.path.length; i++) {
                        this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * i)));
                    }
                } else {
                    for (var i = 0; i < this.path.length; i++) {
                        this.path[i].setAttribute('d', this.updatePath(Date.now() - (this.timeStart + this.delayPerPath * (this.path.length - i - 1))));
                    }
                }
            }
            renderLoop() {
                this.render();
                if (Date.now() - this.timeStart < this.duration + this.delayPerPath * (this.path.length - 1) + this.delayPointsMax) {
                    requestAnimationFrame(() => {
                        this.renderLoop();
                    });
                }
                else {
                    this.isAnimating = false;
                }
            }
        }
        (function() {
            const elmHamburger = document.querySelector('.overlay-hamburger');
            const gNavItems = document.querySelectorAll('.global-menu__item');
            const copyright = document.querySelectorAll('.global-menu-copyright');
            const elmOverlay = document.querySelector('.shape-overlays');
            const overlay = new ShapeOverlays(elmOverlay);
            elmHamburger.addEventListener('click', () => {
                if (overlay.isAnimating) {
                    return false;
                }
                overlay.toggle();
                if (overlay.isOpened === true) {
                    elmHamburger.classList.add('is-opened-navi');
                    for (var i = 0; i < gNavItems.length; i++) {
                        gNavItems[i].classList.add('is-opened');
                    }
                    for (var i = 0; i < copyright.length; i++) {
                        copyright[i].classList.add('is-opened');
                    }
                } else {
                    elmHamburger.classList.remove('is-opened-navi');
                    for (var i = 0; i < gNavItems.length; i++) {
                        gNavItems[i].classList.remove('is-opened');
                    }
                    for (var i = 0; i < copyright.length; i++) {
                        copyright[i].classList.remove('is-opened');
                    }
                }
            });
        }());
    </script>
    <script src="https://unpkg.com/react@16.4.1/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.4.1/umd/react-dom.production.min.js"></script>
    <!--  <script src="https://res.cloudinary.com/laurentiu/raw/upload/v1567281118/bundle_i1uyht.js"></script>  -->
    <!--  <script src="https://res.cloudinary.com/laurentiu/raw/upload/v1567368930/bundle-update-1.0_gkoccv.js"></script>  -->
    <!--  <script src="https://res.cloudinary.com/laurentiu/raw/upload/v1567370886/bundle-1.1.0_ibcynm.js"></script>  -->
    <script src="https://res.cloudinary.com/laurentiu/raw/upload/v1567534721/bundle_mdnokd.js"></script>
    <script>
        var currentSlide = 0;
        var slides = [];
        var videoHeadingEl = document.querySelector('.video-heading-text');
        var videoTitleEl = document.querySelector('.video-title');
        var videoDescriptionEl = document.querySelector('.video-description');
        function showSlide(index) {
            videoHeadingEl.textContent = slides[index].heading;
            videoTitleEl.textContent = slides[index].title;
            videoDescriptionEl.textContent = slides[index].description;
        }
        function processSliders() {
            var sliderItems = document.querySelectorAll('.slider-item');
            sliderItems.forEach(function (item) {
                var heading = item.querySelector('.video-slider-heading-title').textContent;
                var title = item.querySelector('.video-slider-title').textContent;
                var description = item.querySelector('.video-slider-description').textContent;
                slides.push({
                    heading,
                    title,
                    description
                })
            })
        }
        processSliders();
        showSlide(0);
        var animatedText = document.querySelector('.anime-text');
        window.addEventListener('wheel', function(event)
        {
            if (event.deltaY < 0)
            {
                currentSlide--;
                if (currentSlide < 0) {
                    currentSlide = slides.length - 1;
                }
            }
            else if (event.deltaY > 0)
            {
                currentSlide++;
                if (currentSlide >= slides.length) {
                    currentSlide = 0;
                }
            }
            hideAnimation();
            void animatedText.offsetWidth;
            void animatedText.offsetHeight;
            showSlide(currentSlide);
        }, false);
        function hideAnimation() {
            if (!animatedText) {
                animatedText = document.querySelector('.anime-text');
            }
            animatedText.style.top = 0;
            animatedText.style.opacity = 0;
            animatedText.classList.remove('move-text');
        }
        function showSlide(index) {
            if (!animatedText) {
                animatedText = document.querySelector('.anime-text');
            }
            animatedText.style.opacity = 1;
            animatedText.style.top = 0;
            animatedText.classList.add('move-text');
            videoHeadingEl.textContent = slides[index].heading;
            videoTitleEl.textContent = slides[index].title;
            videoDescriptionEl.textContent = slides[index].description;
        }
    </script>

    </body>
</html>
