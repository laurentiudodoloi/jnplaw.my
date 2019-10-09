@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/d2154184d1.js"></script>

    <style>
        canvas {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')

    <div class="open-page">
        <div id="gallery-target"
             data-feed="{{ json_encode(['projects' => $projects, 'company_logo' => asset("images/company_logo.png")]) }}"></div>

        <div class="video-sliders" style="display: none;">
            @foreach($projects as $project)
                <div class="video-slider">{{ $project->resource_url }}</div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/react-app.js') }}"></script>

    <script>
        var logoLayouts = {!! $logoLayouts !!};
    </script>

    <script src="{{ asset('js/logo-size.js')  }}"></script>
@endsection
