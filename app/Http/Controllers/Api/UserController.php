<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        $user = User::where('email', $credentials['username'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Connexion reussite',
            'user' => $user,
            'token' => $token
        ]);


    }

    public function show($id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json(['message' => 'User non trouvé'], 404);
        }

        return response()->json($user);
    }

    public function profile(Request $request)
{
    return response()->json([
        'message' => 'User profile fetched successfully',
        'user' => $request->user()
    ]);
}
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'User logged out successfully']);
    }
    //
}
