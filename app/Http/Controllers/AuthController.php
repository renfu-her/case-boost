<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
      public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user instanceof \App\Models\User) {
                // Hinting here for $user will be specific to the User object
                $token = $user->createToken('authCode')->plainTextToken;
            } 
            
            return response()->json(['message' => 'Logged in successfully.', 'token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}
