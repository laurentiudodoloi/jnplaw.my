@extends('layouts.app')

@section('head')
    {{-- Owl Carousel --}}
    <link href="{{ asset('owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">

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
                        Joseph & Partners
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
                            <span class="tag text-uppercase">architecture</span>
                        </div>
                        <h2 class="title text-left">Spacé Decor Restore</h2>

                        <div class="info-list">
                            <div class="list-item">
                                <div class="top text-uppercase">date</div>
                                <div class="bottom">March 26, 2017</div>
                            </div>

                            <div class="list-item">
                                <div class="top text-uppercase">skills</div>
                                <div class="bottom">UI/UX, JQuery, Sass</div>
                            </div>

                            <div class="list-item">
                                <div class="top text-uppercase">client</div>
                                <div class="bottom">Colabrio Team</div>
                            </div>

                            <div class="list-item">
                                <div class="top text-uppercase">project link</div>
                                <div class="bottom">http://colabr.io</div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="scroll">Scroll</div>
            </div>
        </section>

        <div class="page-wrap">
            <div class="container">

                <section class="section section1">
                    <div class="item-left">
                        <h3 class="title">01. Project Info</h3>
                        <span>Guide to the Nørebro</span>
                    </div>

                    <div class="item-middle">

                        <div class="text text1">
                            Entering that gable-ended Spouter-Inn, you found yourself in a wide, low,
                            straggling entry with old-fashioned wainscots, <strong>reminding</strong>
                            one of the bulwarks of some condemned old craft. On one side hung a very large
                            oilpainting so thoroughly besmoked, and <strong>every way defaced</strong>,
                            that in the unequal crosslights by which you viewed.
                        </div>

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div>Make Concept</div>
                                    <div class="icon"></div>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body text">
                                        When, while the lovely valley teems with vapour around me,
                                        and the meridian sun strikes the upper surface of the impenetrable foliage of my trees,
                                        and but a few stray gleams steal into the inner sanctuary.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div>Prototyping & Design</div>
                                    <div class="icon"></div>
                                </div>

                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body text">
                                        When, while the lovely valley teems with vapour around me,
                                        and the meridian sun strikes the upper surface of the impenetrable foliage of my trees,
                                        and but a few stray gleams steal into the inner sanctuary.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div>Web Development</div>
                                    <div class="icon"></div>
                                </div>

                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body text">
                                        When, while the lovely valley teems with vapour around me,
                                        and the meridian sun strikes the upper surface of the impenetrable foliage of my trees,
                                        and but a few stray gleams steal into the inner sanctuary.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="item-left item-right"></div>
                </section>

                <section class="section2">
                    <div class="img-wrap">
                        <img src="https://colabrio.ams3.cdn.digitaloceanspaces.com/norebro_landing/demo9/2017/10/nor_portfolio_item__31.jpg"
                             alt="" class="img-fluid"
                        >

                        <div class="overlay">
                            <div class="btn-play">&#9658;</div>
                            <div class="text-play text-capitalize">watch video</div>
                        </div>
                    </div>
                </section>

                <section class="section section3">
                    <div class="item-left">
                        <h3 class="title">02. The Story</h3>
                        <span>Guide to the Nørebro</span>
                    </div>

                    <div class="item-middle">
                        <div class="text">
                            Entering that gable-ended Spouter-Inn, you found yourself in a wide, low,
                            straggling entry with old-fashioned wainscots, reminding one of the bulwarks of some
                            condemned old craft. On one side hung a very large oilpainting so thoroughly besmoked,
                            and every way defaced, that in the unequal crosslights by which you viewed.
                        </div>
                    </div>

                    <div class="item-left item-right"></div>
                </section>

                <section class="section4">
                    <div class="owl-carousel owl-theme">
                        <div>
                            <img src="https://colabrio.ams3.cdn.digitaloceanspaces.com/norebro_landing/demo9/2017/10/nor_portfolio_item__32.jpg"
                                 class="img-fluid" alt=""
                            >
                        </div>

                        <div>
                            <img src="https://colabrio.ams3.cdn.digitaloceanspaces.com/norebro_landing/demo9/2017/10/nor_portfolio_item__31.jpg"
                                 class="img-fluid" alt=""
                            >
                        </div>

                        <div>
                            <img  src="https://colabrio.ams3.cdn.digitaloceanspaces.com/norebro_landing/demo9/2017/10/nor_portfolio_item__33.jpg"
                                 class="img-fluid" alt=""
                            >
                        </div>
                    </div>
                </section>

                <section class="section section5">
                    <div class="item-left">
                        <h3 class="title">03. Our Process</h3>
                        <span>Guide to the Nørebro</span>
                    </div>

                    <div class="item-middle">
                        <div class="text">
                            Entering that gable-ended Spouter-Inn, you found yourself in a wide, low,
                            straggling entry with old-fashioned wainscots, reminding one of the bulwarks of some
                            condemned old craft. On one side hung a very large oilpainting so thoroughly besmoked,
                            and every way defaced, that in the unequal crosslights by which you viewed.
                        </div>
                    </div>

                    <div class="item-left item-right"></div>
                </section>

                <section class="section section6">
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="number">01.</div>
                            <div class="title">Idea & Concept</div>
                            <div class="description">
                                Entering that gable-ended Spouter-Inn, you found yourself in a wide,
                                low, straggling entry with wainscots, reminding one of the bulwarks.
                            </div>
                        </div>
                    </div>

                    <div class="item-wrapper">
                        <div class="item">
                            <div class="number">02.</div>
                            <div class="title">Development</div>
                            <div class="description">
                                Entering that gable-ended Spouter-Inn, you found yourself in a wide,
                                low, straggling entry with wainscots, reminding one of the bulwarks.
                            </div>
                        </div>
                    </div>

                    <div class="item-wrapper">
                        <div class="item">
                            <div class="number">03.</div>
                            <div class="title">Testing & Support</div>
                            <div class="description">
                                Entering that gable-ended Spouter-Inn, you found yourself in a wide,
                                low, straggling entry with wainscots, reminding one of the bulwarks.
                            </div>
                        </div>
                    </div>

                </section>
            </div>

            <div class="post-navigation">
                <div class="page-container">
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
        </div>

        <footer class="footer">
            <div class="container">
                <div class="widgets">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <div class="logo">
                                        <a href="#">
                                            <img src="https://colabrio.ams3.cdn.digitaloceanspaces.com/norebro_landing/demo9/2017/10/logo_footer.svg" class="svg-logo img-fluid" alt="Norebro">
                                        </a>
                                    </div>

                                    <form class="form">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                        </div>

                                        <input type="submit" name="subscribe" class="btn-subscribe btn-submit" value="Subscribe">
                                    </form>

                                    <div class="text">
                                        Be the first to find out about exclusive deals, the latest Lookbooks, and top trends.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div>
                                    <div class="title">København</div>
                                    <div class="text text2">
                                        <p>Phone:+1 601 722 8001</p>
                                        <p>Email:norebrotheme@colabr.io</p>
                                        <p>Address:Fensmark 23, København N</p>
                                    </div>

                                    <div class="share">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div>
                                    <div class="title">København</div>
                                    <div class="text text3">
                                        Sofia Helin &nbsp; <a href="#">Norebro is a creative WordPress Theme</a>
                                    </div>
                                    <div class="text text3">
                                        Sofia Helin &nbsp; <a href="#"> on Misses About Bette Davis, Joan Crawford</a>
                                    </div>
                                    <div class="text text3">
                                        Sofia Helin &nbsp; <a href="#"> on New Art Venue Opens in Downtown CF</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div>
                                    <div>
                                        <div class="title">København</div>
                                        <div class="text text4">
                                            <a href="#">Misses About Bette Davis, Joan Crawford</a>
                                            September 27, 2017Business
                                        </div>

                                        <div class="text text4">
                                            <a href="#">New Art Venue Opens in Downtown CF</a>
                                            September 27, 2017Business
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="copyright">
                    <div>
                        &copy; 2017, Nørebro Theme by
                        <a href="#">Colabrio</a> |
                        <a href="#">Privacy policy</a> |
                        <a href="#">Sitemap</a>
                    </div>
                    <div>All Rights Reserved.</div>
                </div>
            </div>
        </footer>

    </div>

@endsection

@section('scripts')
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
        });

        $(window).scroll(function () {

            // Scroll top button
            if (window.matchMedia('(max-width: 767px)').matches) {
                if ($(window).scrollTop() > 800) {
                    $('#page-scroll-top').fadeIn(600);
                } else {
                    $('#page-scroll-top').fadeOut(600);
                }

                $('.scroll-top').on('click', function () {
                    $('html, body').animate({scrollTop: 0}, 500);
                    return false;
                });
            }

        });
    </script>
@endsection
