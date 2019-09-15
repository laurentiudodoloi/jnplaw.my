<?php

namespace App\Http\Controllers;

use App\Eloquent\Project;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('welcome', compact('projects'));
    }
}
