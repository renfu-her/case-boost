<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{
    public function index(Request $request)
    {

        $data = $request->all();

        if (isset($data['slug'])) {
            $search = $data['slug'];
            return response()->json(ProjectCategory::where('slug', $search)->first());
        } else {
            return response()->json(ProjectCategory::all());
        }
    }
}
