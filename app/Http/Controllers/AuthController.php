<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an incoming authentication request for an API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 1. Validation Logic
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt Authentication
        if (Auth::attempt($credentials)) {
            
            // Successful login logic
            $user = Auth::user();
            
            // **API CHANGE:** Generate Token using Sanctum
            $token = $user->createToken('auth_token')->plainTextToken; 
            
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'access_token' => $token, // Data Next.js expects
            ], 200);

        } 
        
        // 3. Failed login logic (Returns JSON 401)
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }


        public function logout(Request $request)
    {
        // The token is available on the request because of the 'auth:sanctum' middleware
        // This command deletes the token record from the personal_access_tokens table.
        $request->user()->currentAccessToken()->delete(); 

        return response()->json([
            'message' => 'Logout successful. Token revoked.'
        ], 200);
    }
}