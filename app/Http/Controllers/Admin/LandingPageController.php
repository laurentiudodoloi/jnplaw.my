<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\LandingPageSlide;
use App\Http\Controllers\Controller;
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
        $id = $id !== 0 ? intval($id) : false;

        $request->validate([
            'title' => 'required|string|max:191',
            'subtitle' => 'required|string|max:191',
        ]);

        $fileNameToStore = '';
        if ($request->hasFile('resource')) {
            $uploaded = FileUploader::store($request->file('resource'));

            if ($uploaded['success']) {
                $fileNameToStore = $uploaded['name'];
            }
        } else {
            $fileNameToStore = false;
        }

        $title = $request->input('title');
        $subtitle = $request->input('subtitle');

        $data = [
            'title' => $title,
            'subtitle' => $subtitle,
        ];

        if ($fileNameToStore && $fileNameToStore !== '') {
            $data['resource_url'] = $fileNameToStore;
        }

        if (isset($id)) {
            $entity = LandingPageSlide::query()->find($id);

            if ($entity && isset($data['resource_url']) && $entity->resource_url !== $fileNameToStore) {
                Storage::delete('public/uploads/'.$entity->resource_url);
            }
        }

        $entity = LandingPageSlide::query()
            ->updateOrCreate([
                'id' => $id,
            ], $data);

        return redirect()->back()->with('success', !!$entity);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(false);
        }

        $entity = LandingPageSlide::query()->findOrFail($id);

        Storage::delete('public/uploads/'.$entity->resource_url);

        $delete = $entity->delete();

        return response()->json(!!$delete);
    }
}
