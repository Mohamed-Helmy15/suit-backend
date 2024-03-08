<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate( [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }
    $token = $user->createToken('my-app-token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function signup(Request $request){
        $request->validate( [
            'name'=>'string|required|min:3|max:20',
            'email'=> 'required|email',
            'password'=> 'required|confirmed',
        ]);
        $user = User::create($request->all());
        $token = $user->createToken('my-app-token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user ]);
    }


}
