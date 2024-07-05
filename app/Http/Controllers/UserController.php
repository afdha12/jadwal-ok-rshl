<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function auth(Request $request) {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        if (Auth::attempt(['username'=> $request->username, 'password'=> $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/schedule');
        };
        return back()->with('loginError', 'Login Failed : Wrong username or password');
    }
}
