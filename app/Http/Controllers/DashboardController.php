<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kas;
use App\Kwitansi;
use App\Logistik;
use App\Peralatan;
use App\Saldo;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Dashboard');
        $request->session()->put('child', 'Dash');

        $brg_count = Barang::count();
        $log_count = Peralatan::count();
        return view('pages.dashboard.index', compact('brg_count', 'log_count'));
    }
}
