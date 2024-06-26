<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $request->user()->currentAccessToken->delete();
        return response()->json(['success' => 'Logged out successfully'], 200);
    }
}