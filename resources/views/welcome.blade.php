@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/d2154184d1.js"></script>
@endsection

@section('content')

    <div class="open-page">
        <div id="gallery-target"></div>

        <div class="video-sliders" style="display: none;">
            <div class="video-slider">{{ asset('videos/street.jpg') }}</div>
            <div class="video-slider">{{ asset('videos/landscape-0.jpg') }}</div>
        </div>

        <ul class="onepage-dots slider-vertical-numbers">
            <li class="active"></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
        </ul>

        <div class="landing-page section-wrapper">
            <div class="header-wrap">
                <div class="brand" style="color: #ffffff;">
                    <a class="text-decoration-none text-white" href="{{ route('welcome') }}">Joseph & Partners</a>
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
                    <span class="date text-uppercase">march 20, 2017</span>

                    <div class="mb-3">
                        <span class="tag text-uppercase">architecture</span>
                    </div>
                    <h2 class="title text-left">Spacé Decor Restore</h2>

                    <div class="info-list">
                        We are specialists in all aspects of shipping law and are a trusted
                        shipping legal firm used by companies not just in Malaysia but internationally.
                        We provide clear, comprehensive advice on all aspects of shipping law.
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
@endsection
