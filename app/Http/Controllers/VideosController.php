<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
      dd(1);
      return view('pages.netflixpage');
    }
}
