<?php

namespace App\Http\Controllers;

use App\Eloquent\LandingPageSlide;
use App\Eloquent\LayoutSize;

class WelcomeController extends Controller
{
    public function index()
    {
        $slides = LandingPageSlide::all()
            ->transform(function ($el) {
                $el->resource_url = 'storage/uploads/'.$el->resource_url;

                return $el;
            })
            ->groupBy('device');

        $logoLayouts = LayoutSize::query()
            ->where('element', 'logo')
            ->get();

        return view('welcome', compact('slides', 'path', 'logoLayouts'));
    }
}
