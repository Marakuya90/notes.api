<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->login = $request->login;
        $user->password = $request->password;
        $user->save();
        $token = $user->createToken('Api token')->plainTextToken;
        return response(['token' => $token], 201);

    }

    public function login(Request $request)
    {
        $data = $request->only(['login','password']);
        if(!Auth::attempt($data))
        {
            return response (['message' => 'Неверный логин или пароль'], 401);

        }
        $token = Auth::user()->createToken('Api token')->plainTextToken;
        return response(['token' => $token],200);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response(['message' => 'ok'], 200);
    }
}
