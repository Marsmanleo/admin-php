<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $User::create([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    public function register(Request $request)
    {
        // 实现用户注册逻辑
        // 例如:
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json(['user' => $user], 201);
    }
}
