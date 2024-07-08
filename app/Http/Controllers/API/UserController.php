<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAuthToken;
use App\Services\API\UserService as Service;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        if (isset($data['email'])) {
            $search = $data['email'];
            return response()->json(User::where('email', $search)->first());
        } else {
            return response()->json(User::all());
        }
    }

    public function show($user_id)
    {
        return User::where('id', $user_id)->first();
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function register(Request $request)
    {
        return (new Service($request))
            ->runValidate(['user'])
            ->register()
            ->getResponse();
    }

    public function userInfo($token)
    {
        $userAuthToken = UserAuthToken::where('token', $token)->with('user')->first();
        return response()->json($userAuthToken, 200);
    }

}
