<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAuthToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user instanceof User) {
                // Hinting here for $user will be specific to the User object
                $token = $user->createToken('authCode')->plainTextToken;

                UserAuthToken::updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'token' => $token,
                        'expires_at' => now()->addDays(1)
                    ]
                );
            }

            return response()->json(['message' => 'Logged in successfully.', 'token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}
