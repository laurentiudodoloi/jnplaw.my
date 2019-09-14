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
                        We are specialists in all aspects of shipping law and are a trusted
                        shipping legal firm used by companies not just in Malaysia but internationally.
                        We provide clear, comprehensive advice on all aspects of shipping law.
                    </div>
                </div>

            </div>

            <div class="scroll">Scroll</div>
        </div>
        {{--<div class="content-wrapper">--}}
            {{--<nav class="navigation">--}}
                {{--<div class="brand px-5">--}}
                    {{--<img src="{{ asset('images/joseph&partners.png') }}" width="209" alt="" class="logo">--}}
                {{--</div>--}}
            {{--</nav>--}}

            {{--<div class="container">--}}
                {{--<div class="content">--}}
                    {{--<div class="item-left">--}}
                        {{--<div class="text-block video-heading-text">Video text 1</div>--}}
                        {{--<h1 class="heading-2 video-title">‍Video title 1</h1>--}}
                        {{--<p class="paragraph video-description">Video description 1</p>--}}
                        {{--<p class="more-info">information</p>--}}
                    {{--</div>--}}

                    {{--<div class="item-right">--}}
                        {{--<a href="#" class="button play-btn w-button">--}}
                            {{--Play >--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="footer">--}}
                {{--<div class="footer-left">--}}
                    {{--<div>#000</div>--}}
                    {{--<div class="text-footer">About Us</div>--}}
                {{--</div>--}}
                {{--<div class="footer-right">--}}
                    {{--<div>#002</div>--}}
                    {{--<div class="text-footer">What We Do</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/react-app.js') }}"></script>
@endsection
