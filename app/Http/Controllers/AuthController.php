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
            return redirect()->route('pokemons.index');
        }

        return back()->withErrors(['email' => 'Las credenciales son incorrectas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function home()
    {
        return view('home', ['user' => Auth::user()]);
    }
}
