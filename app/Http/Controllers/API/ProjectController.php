<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\API\ProjectService as Service;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return (new Service($request))
            ->index()
            ->getResponse();
    }

    public function show(Project $project)
    {
        return $project;
    }

    public function store(Request $request)
    {
        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return response()->json($project, 200);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }

    public function showBySlug($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return response()->json($project);
    }
}
