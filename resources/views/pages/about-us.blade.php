@extends('layouts.app')

@section('head')
    {{-- Owl Carousel --}}
    <link href="{{ asset('owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/floating-animations.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/d2154184d1.js"></script>
@endsection

@section('content')

    <div class="about-us-page">
        <a class="scroll-top" id="page-scroll-top">
            <img src="https://norebro.colabr.io/demo9/wp-content/themes/norebro/assets/images/scroll-top.svg" alt="Scroll to top">
        </a>

        <section class="open-page">
            <img class="open-image" src="https://picsum.photos/id/276/2580/1900" alt="background">

            <div class="section-wrapper">
                <div class="header-wrap">
                    <div class="brand" style="color: #ffffff;">
                        <a class="text-decoration-none text-white" href="{{ route('welcome') }}">
                            <img src="{{ asset("images/company_logo.png") }}" alt="Company logo" class="img-fluid">
                        </a>
                    </div>

                    <div class="header-right">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="content-wrap">

                    <div class="content">
                        <div class="mb-3">
                            <span class="tag text-uppercase">{{ $settings->subtitle ?? '' }}</span>
                        </div>
                        <h2 class="title text-left floating-up-short">{{ $settings->title }}</h2>

                        <div class="info-list floating-up-short-delayed">
                            {{ $settings->description }}
                        </div>
                    </div>

                </div>

                <div class="scroll float-bottom-short">Scroll</div>
            </div>
        </section>

        <div class="page-wrap">
            <div class="container">
                @foreach($sections as $section)
                    <section class="section section1">
                        <div class="item-left">
                            <h3 class="title">{{ $section->title }}</h3>
                            <span>{{ $section->subtitle }}</span>
                        </div>

                        <div class="item-middle">

                            <div class="text text1">
                                {{ $section->description }}
                            </div>

                            @if($section->has_subsections)
                                <div class="accordion" id="subsectionsAccordion">
                                    @foreach($section->subsections as $index => $subsection)
                                        <div class="card">
                                            <div class="card-header" id="{{ 'heading'.$index }}" data-toggle="collapse"
                                                 data-target="{{ '#collapse'.$index }}" aria-expanded="false"
                                                 aria-controls="collapseOne">
                                                <div>{{ $subsection->title }}</div>
                                                <div class="icon"></div>
                                            </div>

                                            <div id="{{ 'collapse'.$index }}" class="collapse"
                                                 aria-labelledby="{{ 'heading'.$index }}"
                                                 data-parent="#subsectionsAccordion">
                                                <div class="card-body text">
                                                    {{ $subsection->content }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="item-left item-right"></div>
                    </section>

                    @if($section->has_image && $section->image_url)
                        <section class="section2">
                            <div class="img-wrap">
                                <img src="{{ $section->image_url }}"
                                     alt="" class="img-fluid"
                                >

                                <div class="overlay">
                                    <div class="btn-play">&#9658;</div>
                                    <div class="text-play text-capitalize">watch video</div>
                                </div>
                            </div>
                        </section>
                    @endif

                    @if($section->has_image_slider)
                        <section class="section4">
                            <div class="owl-carousel owl-theme">
                                @foreach($section->images as $image)
                                    <div>
                                        <img src="{{ $image->image_url }}"
                                             class="img-fluid" alt=""
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    @if($section->has_text_boxes)
                        <section class="section section6">
                            @foreach($section->textBoxes as $textBox)
                                <div class="item-wrapper">
                                    <div class="item">
                                        <div class="number">{{ $textBox->headerText }}</div>
                                        <div class="title">{{ $textBox->title }}</div>
                                        <div class="description">
                                            {{ $textBox->content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </section>
                    @endif
                @endforeach
            </div>

            @if($settings->show_add_comment_form)
                <div class="post-navigation">
                    <div class="container">
                        <div class="nav-container">
                            <div class="nav-item-container">
                                <div class="navigation-wrap navigation-left">
                                    <a href="#">
                                        <span class="nav-icon">&leftarrow;</span>
                                        <span class="nav-content">
                                        <span class="nav-title">previous project</span>
                                        <span class="nav-subtitle">Righteous Besét</span>
                                    </span>
                                    </a>
                                </div>
                            </div>

                            <div class="nav-item-container">
                                <div class="navigation-wrap navigation-right text-right">
                                    <a href="#">
                                    <span class="nav-content">
                                        <span class="nav-title">next project</span>
                                        <span class="nav-subtitle">Crafted för Perfection</span>
                                    </span>
                                        <span class="nav-icon">&rightarrow;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="comments">
                    <div class="container">
                        <div class="container-fluid">
                            <h3 class="title text-left">Post a Comment</h3>
                            <div class="notes">
                                Your email address will not be published.  Required fields are marked *
                            </div>

                            <form class="form">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" placeholder="Name*">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="email" class="form-control" placeholder="E-mail*">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" placeholder="Website">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea rows="8" class="form-control" placeholder="Comment"></textarea>
                                </div>

                                <input type="submit" class="btn btn-outline-dark btn-submit" value="Submit Comment">
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <footer class="footer">
            <div class="container">
                <div class="widgets">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <div class="logo">
                                        <a href="{{ route('welcome') }}">
                                            <img src="{{ asset("images/company_logo.png") }}" class="img-fluid" alt="Company logo">
                                        </a>
                                    </div>

                                    <form class="form">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                        </div>

                                        <input type="submit" name="subscribe" class="btn-subscribe btn-submit" value="Subscribe">
                                    </form>

                                    <div class="text">
                                        Sign up for e-updates and be the first to hear about latest developments in Malaysian maritime law.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div>
                                    <div class="title">Contact Us</div>
                                    <div class="text text2">
                                        <p>Phone:+603 6203 7877</p>
                                        <p>Email:info@jnplaw.my</p>
                                        <p>Address:Suite J-7-2 <br>
                                                   Solaris Mont Kiara <br>
                                                   Jalan Solaris <br>
                                                   50480 Kuala Lumpur <br>
                                                   Malaysia
                                        </p>
                                    </div>

                                    <div class="share">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div>
                                    <div class="title">About J&P</div>
                                    <div class="text text3">
                                        <a href="{{ route('about-us') }}">About Us</a>
                                    </div>
                                    <div class="text text3">
                                        <a href="{{ route('about-us') }}">What We Do</a>
                                    </div>
                                    <div class="text text3">
                                        <a href="{{ route('about-us') }}">Our People</a>
                                    </div>
                                    <div class="text text3">
                                        <a href="{{ route('about-us') }}">Our Knowledge</a>
                                    </div>
                                    <div class="text text3">
                                        <a href="{{ route('about-us') }}">News</a>
                                    </div>
                                    <div class="text text3">
                                        <a href="{{ route('about-us') }}">Events</a>
                                    </div>
                                    <div class="text text3">
                                        <a href="{{ route('about-us') }}">Contact Us</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div>
                                    <div>
                                        <div class="title">Community</div>
                                        <div class="text text4">
                                            <a href="#">
                                                <i class="fa fa-facebook mr-1"></i>
                                                Facebook
                                            </a>
                                        </div>

                                        <div class="text text4">
                                            <a href="#">
                                                <i class="fa fa-twitter mr-1"></i>
                                                Twitter
                                            </a>
                                        </div>

                                        <div class="text text4">
                                            <a href="#">
                                                <i class="fa fa-facebook mr-1"></i>
                                                G-mail
                                            </a>
                                        </div>

                                        <div class="text text4">
                                            <a href="#">
                                                <i class="fa fa-instagram mr-1"></i>
                                                Instagram
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="copyright">
                    <div>
                        &copy; 2019, Joseph & Partners
                    </div>
                    <div>All Rights Reserved.</div>
                </div>
            </div>
        </footer>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/page-text-floats.js') }}"></script>
    <script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>

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

            const hamburgerMenu = document.querySelector('.hamburger-menu')
            $(window).scroll(function (evt) {
                if ($(window).scrollTop() > 708 && !hamburgerMenu.classList.contains('hamburger-menu-closed')) {
                    hamburgerMenu.querySelectorAll('.line').forEach(el => {
                        el.style.backgroundColor = '#000';
                    })
                    hamburgerMenu.querySelector('.hamburger-menu-text').style.color = '#000';
                } else {
                    hamburgerMenu.querySelectorAll('.line').forEach(el => {
                        el.style.backgroundColor = '#fff';
                    })
                    hamburgerMenu.querySelector('.hamburger-menu-text').style.color = '#fff';
                }
            });
        });

        if (window.matchMedia('(max-width: 768px)').matches) {

            $(window).scroll(function () {
                // Scroll top button
                if ($(window).scrollTop() > 800) {
                    $('#page-scroll-top').fadeIn(600);
                } else {
                    $('#page-scroll-top').fadeOut(600);
                }
            });

            $('.scroll-top').on('click', function () {
                $('html, body').animate({scrollTop: 0}, 500);
                return false;
            });

        }
    </script>
@endsection
