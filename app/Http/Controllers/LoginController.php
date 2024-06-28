<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index(){
        return view("login.index");
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            "email" => "required|email:dns",
            "password" => "required"
        ]);

        if($credentials["email"] == 'admin@gmail.com'){
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                    return redirect()->intended('/admin/user');
            }
        }else{
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                    return redirect()->intended('/alumni');
            }
        }
        
        return back()->with("loginError", "Login failed");
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect("/");
    }
}
