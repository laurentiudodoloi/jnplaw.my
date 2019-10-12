<?php

namespace App\Http\Controllers;

use App\Eloquent\LandingPageSlide;
use App\Util\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    public function index()
    {
        $slides = LandingPageSlide::all();

        return response()->json($slides);
    }

    public function get($id)
    {
        $slide = LandingPageSlide::query()->findOrFail($id);

        return response()->json($slide);
    }

    public function store(Request $request, $id = 0)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $fileNameToStore = '';
        $resourceType = 'image';

        if ($request->hasFile('resource')) {
            $uploaded = FileUploader::store($request->file('resource'));

            if ($uploaded['success']) {
                $fileNameToStore = $uploaded['name'];
                $resourceType = $uploaded['type'];
            }
        }

        $title = $request->input('title');
        $description = $request->input('description');

        $entity = LandingPageSlide::query()
            ->updateOrCreate([
                'id' => $id,
            ], [
                'title' => $title,
                'description' => $description,
                'resource_url' => $fileNameToStore,
                'resource_type' => $resourceType,
            ]);

        return redirect()->back()->with('success', !!$entity);
    }

    public function destroy($id)
    {
        $entity = LandingPageSlide::query()->findOrFail($id);

        Storage::delete('public/uploads/'.$entity->resource_url);

        $delete = $entity->delete();

        return response()->json(!!$delete);
    }
}
