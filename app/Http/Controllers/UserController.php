<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index()
{
    return view('home');
}


public function showRegistrationForm()
{
    return view('auth.register');
}
public function register(Request $request)
{
    Log::info('Registration request:', $request->all());
    
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email'], // Ensure unique email
        // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }
    
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash the password
    ]);
    
    return response()->json([
        'message' => 'User successfully registered',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]
    ], 201);
}

public function showLoginForm()
{
    return view('auth.login'); 
}
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $token
        ]);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}


// User Logout method
public function logout(Request $request)
{
    $request->user()->tokens->each(function ($token) {
        $token->delete();
    });

    return response()->json(['message' => 'Logged out successfully']);
}
}


