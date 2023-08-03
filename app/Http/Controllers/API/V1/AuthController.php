<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\V1\UserLoginResource;

class AuthController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'dashboard']]);
    }

    public function login(LoginUserRequest $request)
    {
        
        $token = Auth::attempt($request->validated());
        
        if (!$token) {
            return response()->json([
                'message' => 'Não autorizado!',
            ], 401);
        }
        
        $user = Auth::user();
        $user->token = $token;
        
        return new UserLoginResource($user);
    }

    public function register(RegisterUserRequest $request)
    {

        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }


    public function logout()
    {
        Auth::logout();
        
        return response()->json([
            'messagem' => 'Logout com sucesso.',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer'
            ]
        ]);
    }
}



