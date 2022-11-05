<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->login = $request->login;
        $user->password = $request->password;
        $user->save();
        $token = $user->createToken('Api token')->plainTextToken;
        return response(['token' => $token], 201);

    }
}
