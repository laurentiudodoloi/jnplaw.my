<?php

namespace App\Http\Controllers;

use App\Eloquent\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return response()->json($projects);
    }

    public function get($id)
    {
        $project = Project::query()->where('id', $id);

        return response()->json($project);
    }

    public function store(Request $request, $id = 0)
    {
        $new = $id === 0;

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|string',
        ]);

        $entity = false;
        if ($new) {
            $resourceUrl = $request->input('resource_url');

            $entity = Project::query()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'resource_url' => $resourceUrl,
                'resource_type' => $request->input('resource_type'),
            ]);

            if ($entity) {
                $image = $request->input('image');

                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace('data:image/jpg;base64,', '', $image);
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace('data:video/mp4;base64,', '', $image);

                $image = str_replace(' ', '+', $image);

                $imageName = $resourceUrl;

                Storage::disk('uploads')->put($imageName, base64_decode($image));
            }
        } else {
            $entity = Project::query()
                ->updateOrCreate([
                    'id' => $id,
                ], [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'resource_url' => $request->input('resource_url'),
                    'resource_type' => $request->input('resource_type'),
                ]);
        }

        return response()->json($entity);
    }

    public function destroy($id)
    {
        $delete = Project::query()
            ->where('id', $id)
            ->delete();

        return response()->json(!!$delete);
    }
}
