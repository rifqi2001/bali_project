<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function actionlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->hasRole('superAdmin')) {
                return redirect()->route('dashboard')->with('success', 'Selamat Datang, ' . $user->name);
            } else {
                return redirect()->route('login')->with('error', 'Login failed, please check your credentials.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Login failed, please check your credentials.');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful!');
    }
}
