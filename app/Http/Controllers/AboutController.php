<?php

namespace App\Http\Controllers;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\LayoutSize;

class AboutController extends Controller
{
    public function index()
    {
        $localPath = 'uploads/';
        $livePath = 'jnplaw/public/uploads/';

        $path = $livePath;

        $settings = AboutUsSetting::query()->first();
        $sections = AboutUsSection::query()
            ->with([
                'subsections',
                'images',
                'textBoxes',
            ])
            ->get();

        $logoLayouts = LayoutSize::query()
            ->where('element', 'logo')
            ->get();

        return view('pages.about-us', compact('settings', 'sections', 'path', 'logoLayouts'));
    }
}
