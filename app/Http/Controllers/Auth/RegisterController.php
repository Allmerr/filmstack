<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request) {
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);
        if($request->password !== $request->password_confirmation){
        return back()->withErrors([
            'password' => 'The password confirmation does not match.',
            ])->withInput();
        }
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
            
        // Create the user
        $user = \App\Models\User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        
        
        // Log the user in
        auth()->login($user);
        
        // Redirect to dashboard or intended page
        return redirect()->intended('welcome');
    }
}

