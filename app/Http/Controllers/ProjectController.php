<?php

namespace App\Http\Controllers;

use App\Eloquent\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
        $supportImageFormats = ['jpg', 'jpeg', 'png'];
        $supportVideoFormats = ['mp4'];

        $new = $id === 0;
        $hasImage = true;

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        if (!$request->file('resource') ||
            !array_search($request->file('resource')->extension(), array_merge($supportImageFormats, $supportVideoFormats))) {
            $hasImage = false;
        }

        $resource = $request->file('resource');

        $title = $request->input('title');
        $description = $request->input('description');
        $resourceUrl = $resource ? 'uploads/'.$resource->getClientOriginalName() : false;

        $mime = $resource ? $resource->getClientMimeType() : false;

        $resourceType = false;
        if (strpos($mime, 'image') !== false) {
            $resourceType = 'image';
        } elseif (strpos($mime, 'video') !== false) {
            $resourceType = 'video';
        }

        if (!$resourceType) {
            $hasImage = false;
        }

        if (!$resource || !Storage::disk('uploads')->put($resource->getClientOriginalName(), $resource->get())) {
            $hasImage = false;
        }

        if (!$hasImage && $new) {
            return redirect()->back()->with('success', false);
        }

        $entity = Project::query()->find($id);

        $entity = Project::query()
            ->updateOrCreate([
                'id' => $id,
            ], [
                'title' => $title,
                'description' => $description,
                'resource_url' => $resourceUrl ? $resourceUrl : $entity->resource_url,
                'resource_type' => $resourceType ? $resourceType : $entity->resource_type,
            ]);

        return redirect()->back()->with('success', !!$entity);
    }

    public function destroy($id)
    {
        $delete = Project::query()
            ->where('id', $id)
            ->delete();

        return response()->json(!!$delete);
    }
}
