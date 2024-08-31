<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // if (Auth::guard('api')->attempt($credentials)) {
        //     $user = Auth::guard('user')->user();
        //     $token = $user->createToken('UserToken')->accessToken;

        //     return response()->json(['token' => $token], 200);
        // }
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('UserToken')->accessToken;

            // return response()->json(['token' => $token], 200);
            return response()->json(['token' => $token, 'user' => $user], 200);
        }
        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();
        //     $token = $user->createToken('UserToken')->accessToken;

        //     return response()->json(['token' => $token, 'user' => $user], 200);
        // }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}