<?php

namespace App\Http\Controllers;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\LayoutSize;

class AboutController extends Controller
{
    public function index()
    {
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

        $path = config('app.upload_path');

        return view('pages.about-us', compact('settings', 'sections', 'logoLayouts', 'path'));
    }
}
