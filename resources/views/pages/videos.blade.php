@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videos-page.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/0bee301056.js"></script>
@endsection

@section('content')
    <div class="videos">

        <div class="sidebar">
            <div class="menu">&#9776;</div>
        </div>

        <div id="vue-app" class="page-wrap">
            <div class="slider-rect">
                <slider :slides="{{ json_encode($mainMovies) }}" :no-of-slides="2"></slider>
            </div>

            <div class="">
                <h3 class="slider-header font-weight-bold">Limited edition</h3>
                <div class="product">
                    <div>
                        <img src="https://picsum.photos/800/500?random=2" class="img-fluid">
                    </div>

                    <div class="product-description text2 text-justify">
                        Entering that gable-ended Spouter-Inn, you found yourself in a wide, low,
                        straggling entry with old-fashioned wainscots, <strong>reminding</strong>
                        one of the bulwarks of some condemned old craft. On one side hung a very large
                        oilpainting so thoroughly besmoked, and <strong>every way defaced</strong>,
                        that in the unequal crosslights by which you viewed.
                    </div>

                </div>
            </div>

            <div>
                <slider
                        :slides="{{ json_encode($movies) }}"
                        :no-of-slides="4"
                        head="Premium edition"
                ></slider>
            </div>

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

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/vue-app.js') }}"></script>
@endsection
