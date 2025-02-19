<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Usuario autenticado correctamente
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Las credenciales ingresadas son incorrectas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('dashboard', ['user' => Auth::user()]);
    }

    public function home()
    {
        return view('home', ['user' => Auth::user()]);
    }
}
