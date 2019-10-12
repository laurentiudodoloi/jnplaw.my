<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'subtitle' => 'required|string|max:191',
            'description' => 'required|string|max:255',
        ]);

        dd(
            $request->allFiles(),
            $request->all()
        );
    }
}
