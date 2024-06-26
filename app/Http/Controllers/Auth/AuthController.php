<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //__Register
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        if ($user) {
            $token = $user->createToken('auth_token')->plainTextToken;
        }
        return response()->json([
            'success' => 'Restricted successfully.',
            'token' => $token
        ]);
    }

    //__Login
    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['invalid' => 'Invalid email or password']);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'success' => 'Login successful',
            'token' => $token
        ]);
    }

}