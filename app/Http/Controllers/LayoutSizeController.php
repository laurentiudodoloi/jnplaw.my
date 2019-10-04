<?php

namespace App\Http\Controllers;

use App\LayoutSize;
use Illuminate\Http\Request;

class LayoutSizeController extends Controller
{
    public function index($element, Request $request)
    {
        $data = LayoutSize::query()
            ->where('element', $element)
            ->get();

        return response()->json($data);
    }

    public function store($element, Request $request)
    {
        $layouts = $request->input('layouts');

        LayoutSize::query()
            ->where('element', $element)
            ->delete();

        foreach ($layouts as $layout) {
            LayoutSize::query()
                ->create([
                    'element' => $element,
                    'fixed_width' => $layout['fixed_width'],
                    'width' => $layout['width'],
                    'height' => $layout['height'],
                    'unit' => 'px',
                ]);
        }

        return redirect()->back();
    }
}
