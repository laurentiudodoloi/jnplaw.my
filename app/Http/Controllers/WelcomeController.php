<?php

namespace App\Http\Controllers;

use App\Eloquent\Project;
use App\LayoutSize;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $localPath = 'uploads/';
        $livePath = 'jnplaw/public/uploads/';

        $path = $livePath;

        $projects = Project::all();

        $logoLayouts = LayoutSize::query()
            ->where('element', 'logo')
            ->get();

        return view('welcome', compact('projects', 'path', 'logoLayouts'));
    }
}
