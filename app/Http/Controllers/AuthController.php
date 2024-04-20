<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Extract credentials from the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (! $token = Auth::attempt($credentials)) {
            // Unauthorized response
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Successful login response
        return response()->json([
            'message' => 'Login Successful!',
            'access_token' => $token,
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        // Successful logout response
        return response()->json(['message' => 'Successfully logged out']);
    }
}
