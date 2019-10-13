<?php

namespace App\Http\Controllers;

use App\Eloquent\LandingPageSlide;
use App\Eloquent\LayoutSize;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $localPath = 'uploads/';
        $livePath = 'jnplaw/public/uploads/';

        $path = $livePath;

        $projects = LandingPageSlide::all();

        $logoLayouts = LayoutSize::query()
            ->where('element', 'logo')
            ->get();

        return view('welcome', compact('projects', 'path', 'logoLayouts'));
    }
}
