<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function _construct()
    {
        $this->middleware('auth:api', ['execut' => ['login', 'register']]);
    }
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 204);
        }
        return $this->createNewToken($token);
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
    public function profile()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'User logged out'
        ], 201);
    }
}
