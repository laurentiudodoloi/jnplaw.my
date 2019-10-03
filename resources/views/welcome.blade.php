@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/d2154184d1.js"></script>
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
        window.addEventListener('wheel', onWheel)

        function onWheel (evt) {
            console.log('WHEEL')
        }
    </script>
@endsection
