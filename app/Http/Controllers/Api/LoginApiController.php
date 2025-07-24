<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check for existing token that has not expired
            $existingToken = $user->tokens()
                ->where('name', 'API Token')
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                          ->orWhere('expires_at', '>', Carbon::now());
                })
                ->first();

            if ($existingToken) {
                return response()->json([
                    'message' => 'Login successful. Using existing token.',
                    'token' => '[Token already exists and cannot be retrieved again]',
                    'user' => $user,
                ], 200);
            }

            // Delete expired or previous tokens
            $user->tokens()->delete();

            // Create a new token with expiration (e.g., 1 hour)
            $token = $user->createToken('API Token')->plainTextToken;

            // Manually update expiration
            $user->tokens()->latest()->first()->update([
                'expires_at' => now()->addHour()
            ]);

            return response()->json([
                'message' => 'Login successful. New token created.',
                'token' => $token,
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid credentials.',
        ], 401);
    }
}
