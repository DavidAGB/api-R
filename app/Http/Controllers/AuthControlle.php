<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use \stdClass;
use plainTextToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthControlle extends Controller
{


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token =  $user->createToken('auth_token')->plainTextToken;
        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'No autorizado'], 401);
        }else {
            $user = User::where('email', $request['email'])->firstOrfail();
            $token =  $user->createToken('auth_token')->plainTextToken;
    
            return response()->json(['message' => 'Bienvenido ' . $user->name, 'access_token' => $token, 'token_type' => 'Bearer', 'user' => $user],200);
        }

         
    }

    public function  logout(){

       Auth()->user()->tokens()->delete();

        return [
            'message' => 'metodos y tokens de autenticacion han sido borrados'
        ];
    }
}
