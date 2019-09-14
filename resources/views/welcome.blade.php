@extends('layouts.app')

@section('head')
@endsection

@section('content')

    <div id="gallery-target"></div>

    <div class="video-sliders" style="display: none;">
        <div class="video-slider">{{ asset('videos/street.jpg') }}</div>
        <div class="video-slider">{{ asset('videos/landscape-0.jpg') }}</div>
    </div>

    <div class="content-wrapper">
        <nav class="navigation">
            <div class="brand px-5">
                <img src="{{ asset('images/joseph&partners.png') }}" width="209" alt="" class="logo">
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
    <script src="{{ asset('js/react-app.js') }}"></script>
@endsection
