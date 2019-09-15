<?php

namespace App\Http\Controllers;

use App\Eloquent\Project;
use Illuminate\Http\Request;

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
        ]);

        $entity = false;
        if ($new) {
            $entity = Project::query()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'resource_url' => 'test',
                'resource_type' => 'image',
            ]);
        } else {
            $entity = Project::query()
                ->updateOrCreate([
                    'id' => $id,
                ], [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'resource_url' => 'test',
                    'resource_type' => 'image',
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
