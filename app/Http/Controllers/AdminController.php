<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.landing-page');
    }

    public function about()
    {
      return view('admin.about');
    }
}
