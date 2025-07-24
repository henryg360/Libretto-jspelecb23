<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterApiController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'message' => 'Registration successful.',
            'user' => $user,
        ], 201);
    }
}
