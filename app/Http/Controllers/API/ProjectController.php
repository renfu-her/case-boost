<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\UserAuthToken;
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

    public function show($project_id)
    {
        return Project::where('id', $project_id)->with('user')->first();
    }

    public function store(Request $request)
    {
        $token = $request->input('token');
        $userAuthToken = UserAuthToken::where('token', $token)->first();

        if ($userAuthToken) {
            $user_id = $userAuthToken->user_id;
            $projectData = $request->all();
            $projectData['user_id'] = $user_id;

            $project = Project::create($projectData);
            return response()->json($project, 201);
        } else {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }

    public function update(Request $request, $projectId)
    {
        $project = Project::where('id', $projectId)->first();
        $projectData = $request->all();
        $project->update($projectData);
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
