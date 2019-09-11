@extends('layouts.app')

@section('content')

    <div class="about-us-page">

        <div class="sidebar">
            <div class="menu">&#9776;</div>
        </div>

        <section class="open-page">
            <img class="open-image" src="https://picsum.photos/id/276/4250/2801" alt="background">

            <div class="section-wrapper">
                <div class="header-wrap">
                    <div class="brand">
                        <img src="https://colabrio.ams3.cdn.digitaloceanspaces.com/norebro_landing/demo9/2017/10/logo_inverse.svg" class="svg-logo" alt="Norebro">
                    </div>

                    <div class="header-right">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="#">
                                    <i class="fa fa-facebook">f</i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    <i class="fa fa-twitter">t</i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    <i class="fa fa-dribbble">o</i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">
                                    <i class="fa fa-search">s</i>
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
            <div class="page-container">

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

                    <div class="item-left"></div>
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

                    <div class="item-left"></div>
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

                    <div class="item-left"></div>
                </section>

            </div>
        </div>

    </div>

@endsection
