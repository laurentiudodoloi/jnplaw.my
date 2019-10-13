<?php

namespace App\Http\Controllers;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\LandingPageSlide;

class AdminController extends Controller
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

        $aboutPageContent = [
            'settings' => $settings,
            'sections' => $sections,
        ];

        $data = [
            'slides' => LandingPageSlide::all(),
            'about' => $aboutPageContent,
        ];

        return view('admin.dashboard', compact('data'));
    }
}
