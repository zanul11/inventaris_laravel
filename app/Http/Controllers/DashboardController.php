<?php

namespace App\Http\Controllers;

use App\Barang;
use App\JenisDokumen;

use App\Pemasukan;
use App\Pengeluaran;
use App\Peralatan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Dashboard');
        $request->session()->put('child', 'Dash');

        $brg_count = Barang::count();
        $log_count = Peralatan::count();
        $pemasukan = Pemasukan::where('jenis', 1)->where('status', '1')->whereMonth('tgl', date('m'))->sum('jumlah');
        $pengeluaran = Pemasukan::where('jenis', 0)->where('status', '1')->whereMonth('tgl', date('m'))->sum('jumlah');
        $barang = Barang::whereColumn('stok', '<=', 'minimum')->get();
        $peralatan = Peralatan::whereColumn('stok_aktif', '<=', 'rusak')->get();

        $dok = JenisDokumen::where(DB::raw('DATEDIFF(tanggal,CURDATE())'), '<=', 29)->with('pegawai')->get();


        return view('pages.dashboard.index', compact('brg_count', 'log_count', 'pemasukan', 'pengeluaran', 'barang', 'peralatan', 'dok', 'pengeluaran'));
    }
}
