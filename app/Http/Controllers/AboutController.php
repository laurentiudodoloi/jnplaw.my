<?php

namespace App\Http\Controllers;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSectionImage;
use App\Eloquent\AboutUsSectionTextBox;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\AboutUsSubSection;
use Illuminate\Http\Request;

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

        return view('pages.about-us', compact('settings', 'sections'));
    }
}
