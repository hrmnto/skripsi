<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index(){
        return view("register.index");
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "name" => "required|max:255",
            "email" => ["required", "min:3", "max:255", "unique:users"],
            "password" => "required|min:5|max:255",
            "nim" => "required|min:5|max:255"
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        $request->session()->flash('success', 'Registration successfull! Please Login');
        return redirect('/login');
    }
}
