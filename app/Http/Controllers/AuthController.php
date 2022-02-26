<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.auth.index');
    }

    public function show(Request $request)
    {
        if (Auth::attempt(['user'=>$request->user, 'password'=>$request->password, 'status'=>1])) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors('authenticate');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return Redirect::to('/');
    }
}
