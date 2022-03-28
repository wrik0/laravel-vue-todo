<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $r)
    {   

        $data = $r->validate([
            "name" => "required|string",
            "email" => "required|email|string|unique:users,email",
            "password" => [
                "required", "confirmed", 
                Password::min(8)->mixedCase()->numbers()->symbols()->letters()
            ]
        ]);
        
        
        /** @var \App\Models\User $user */
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"])
        ]);
        $token = $user->createToken("main")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ]);
    }

    public function login(Request $r)
    {
        $credentials = $r->validate(([
            "email" => "required|email|string",
            "password" => "string",
            "remember" => "boolean"
        ]));

        $remember = $credentials["remember"];
        unset($credentials["remember"]);

        if(!Auth::attempt($credentials, $remember)){
            return response()->json([
                "status" => "Unauthorized",
                "message" => "Invalid Credentials"
            ], Response::HTTP_FORBIDDEN);
        }
        $user = Auth::user();
        $token = $user->createToken("main")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ]);
    }

    public function logout(Request $r)
    {
        $user = Auth::user();
    }
}
