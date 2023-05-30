<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email|max:255|string',
            'password' => 'required|string|max:255|min:8'
        ]);

        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'message' => 'Invalid credentials, please check your email and password or create new account',
                'errors' => [
                    'email' => 'Invalid credentials',
                    'password' => 'Incorrect password'
                ]
            ], 403);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'message' => 'Request successfully.',
            'current_user' => $user,
            'access_token' => $token
        ]);
    }
    
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255|string',
            'password' => 'required|min:8|string|confirmed'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'message' => 'Request successfully.',
            'current_user' => $user,
            'access_token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}
