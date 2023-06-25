<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        $field = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => bcrypt($field['password'])
        ]);
        $token = $user->createToken('myapp')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response, 201);
    }
    public function login(Request $request)
    {

        $field = $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);
        $user = User::where('email', $field['email'])->first();
        if (!$user || !Hash::check($field['password'],$user->password)) {
            return 'this token is not found';
        } else {
            $token = $user->createToken('myapp')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
            ];
            return response($response, 200);
        }
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'your token is deleted',
        ];
    }
}
