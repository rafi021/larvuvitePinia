<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation  = Validator::make($request->all(), [
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|max:255|email|unique:users',
            'password' => 'bail|required|string|min:4|confirmed',
        ]);

        if($validation->fails()){
            $response = [
                'status' => 400,
                'success' => false,
                'message' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $response = [
            'status' => 200,
            'success' => true,
            'message' => 'User Registration Done',
            'data' => [
                'user' => [
                    'token' => $user->createToken('MyApp')->plainTextToken,
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]
        ];

        return response()->json($response, 200);

    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))){
            $user = Auth::user();
            $response = [
                'status' => 200,
                'success' => true,
                'message' => 'User Login Done',
                'data' => [
                    'user' => [
                        'token' => $user->createToken('MyApp')->plainTextToken,
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ]
                ]
            ];

            return response()->json($response, 200);
        }else{
            $response = [
                'status' => 400,
                'success' => false,
                'message' => 'Unauthorized!'
            ];

            return response()->json($response, 400);
        }
    }
}
