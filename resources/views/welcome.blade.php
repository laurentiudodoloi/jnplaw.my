@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/d2154184d1.js"></script>
@endsection

@section('content')

    <div class="open-page">
        <div id="gallery-target" data-feed="{{ json_encode($projects) }}"></div>

        <div class="video-sliders" style="display: none;">
            @foreach($projects as $project)
                <div class="video-slider">{{ $project->resource_url }}</div>
            @endforeach
        </div>

        <div class="landing-page section-wrapper" hidden>
            <div class="header-wrap">
                <div class="brand" style="color: #ffffff;">
                    <a class="text-decoration-none text-white" href="{{ route('welcome') }}">
                        <img src="{{ asset("images/company_logo.png") }}" alt="Company logo" class="img-fluid">
                    </a>
                </div>

                <div class="header-right">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-white hidden" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="content-wrap">

                <div class="content">
                    <span class="date text-uppercase">march 20, 2017</span>

                    <div class="mb-3">
                        <span class="tag text-capitalize">A Leading Maritime & Commercial Law Firm</span>
                    </div>
                    <h2 class="title text-left">Niche Firm, Big Difference</h2>

                    <div class="info-list">
                        We are specialists in all aspects of shipping law and are a trusted shipping
                        legal firm used by companies not just in Malaysia but internationally.
                        We provide clear, comprehensive advice on all aspects of shipping law.
                    </div>

                    <div class="play-video norebro-video-module-sc video-module">
                        <div class="btn-play">
                            <a href="#">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                        <div class="content-center">
                            <div class="wrap">
                                <div class="play-content">
                                    <a href="#">
                                        Play video
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="scroll">Scroll</div>
        </div>

        <div class="message-box">
            <i class="fa fa-envelope"></i>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/react-app.js') }}"></script>

    <script>
        window.addEventListener('wheel', onWheel)

        function onWheel (evt) {
            console.log('WHEEL')
        }
    </script>
@endsection
