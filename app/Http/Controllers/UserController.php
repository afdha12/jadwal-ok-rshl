<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


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
        return back()->withErrors('Username atau Password salah !');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
