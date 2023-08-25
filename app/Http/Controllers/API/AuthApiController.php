<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // user Registeration
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'message' => 'Welcom New User',
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    // user login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response('wrong email or password ');
        } else {
            $token = $user->createToken('myToken')->plainTextToken;

            $response = [
                'message' => 'welcome again',
                'user' => $user,
                'token' => $token
            ];

            return response($response, 200);
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'loged out'
        ];
    }
}
