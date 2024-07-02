<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("login.index");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email:dns",
            "password" => "required"
        ]);

        if ($credentials["email"] == 'admin@gmail.com') {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/user')->with("success", "Login success");
            }
        } else {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/alumni')->with("success", "Login success");
            }
        }
        return back()->with("loginError", "Login failed")->withInput();
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect("/");
    }
}
