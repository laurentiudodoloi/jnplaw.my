@extends('layouts.app')

@section('includes')
    <link href="{{ asset('css/videos-page.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="vue-app">
        <div class="slider-rect">
            <slider :slides="{{ json_encode($mainMovies) }}" :no-of-slides="2"></slider>
        </div>

        <div>
            <slider
                :slides="{{ json_encode($movies) }}"
                :no-of-slides="4"
                head="Limited edition"
            ></slider>
        </div>

        <div>
            <slider
                :slides="{{ json_encode($movies) }}"
                :no-of-slides="3"
                head="Premium"
            ></slider>
        </div>

        <div>
            <slider
                :slides="{{ json_encode($movies) }}"
                :no-of-slides="5"
                head="Latest videos"
            ></slider>
        </div>
    </div>
@endsection
