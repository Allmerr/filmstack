<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request) {
        return view('auth.login');
    }

    public function store(Request $request){
        // Validate the form data
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6',
        ]);
        
        // Attempt to authenticate the user
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('welcome');
        }
        
        // Authentication failed...
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput();
            
        
    }

}
