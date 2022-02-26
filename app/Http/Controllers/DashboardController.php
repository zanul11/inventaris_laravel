<?php

namespace App\Http\Controllers;

use App\Kas;
use App\Kwitansi;
use App\Saldo;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Dashboard');
        $request->session()->put('child', 'Dash');
        // $user = User::with('jabatans')->paginate(10);
        // return Auth::user()->menus();
        $total = Kwitansi::where('status', 0)->sum('jumlah');
        // $uang = Saldo::orderBy('id', 'desc')->orderBy('created_at', 'desc')->first();
        $uang = Saldo::orderBy('id', 'desc')->orderBy('created_at', 'desc')->first();
        $kk = Kas::orderBy('created_at', 'desc')->first();
        return view('pages.dashboard.index', compact('total', 'uang', 'kk'));
    }
}
