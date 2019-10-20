<?php

namespace App\Http\Controllers;

use App\Eloquent\LandingPageSlide;
use App\Eloquent\LayoutSize;

class WelcomeController extends Controller
{
    public function index()
    {
        $path = config('app.upload_path');

        $slides = LandingPageSlide::all()
            ->transform(function ($el) use ($path) {
                $el->resource_url = $path.'/'.$el->resource_url;

                return $el;
            })
            ->groupBy('device');

        $logoLayouts = LayoutSize::query()
            ->where('element', 'logo')
            ->get();

        return view('welcome', compact('slides', 'logoLayouts', 'path'));
    }
}
