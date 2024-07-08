<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Feedback::create($request->all());

        return response()->json(['message' => '回饋提交成功'], 201);
        
    }
}
