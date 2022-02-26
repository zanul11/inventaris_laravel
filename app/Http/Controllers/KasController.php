<?php

namespace App\Http\Controllers;

use App\Kas;
use App\KasTmp;
use Illuminate\Http\Request;
use App\Kwitansi;
use App\KwitansiDetail;
use Yajra\DataTables\DataTables;

use App\Pegawai;
use App\Saldo;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Kas Kecil');
        $request->session()->put('child', 'Kas Kecil');
        return view('pages.kas.index');
    }

    public function getServerSide()
    {
        $kas = Kas::orderBy('created_at', 'desc')->get();
        return Datatables::of($kas)
            ->addIndexColumn()
            ->addColumn('tgl', function ($row) {
                return $row->created_at->format('d/m/Y');
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a href="/kas/' . $row->id . '" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                <a onclick="btnDelete(\'' . $row->kode . '\')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
                <button id="" class="btn btn-white dropdown-toggle" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                    <a href="/kas/' . $row->id . '/edit" class="dropdown-item" target="_blank"> Cetak Kas Kecil</a>
                    <a href="/rkk?kode=' . $row->kode . '" class="dropdown-item" target="_blank"> Cetak RKK</a>
                    <a href="/voucher?kode=' . $row->kode . '" class="dropdown-item" target="_blank"> Cetak Voucher KK</a>
                </div>
            </div>';
                return $btn;
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cetakRKK()
    {
        $kode = request('kode');
        $kwitansi = Kwitansi::where('kode_kas', $kode)->orderBy('tgl', 'desc')->first();
        $kas = Kas::where('kode', $kode)->first();
        $dataRkk =  DB::select("select  jenis_kwitansi.jenis as penjelasan, sum(kwitansi.jumlah) as jumlah from kwitansi, jenis_kwitansi 
        where jenis_kwitansi.id=kwitansi.jenis AND kode_kas='$kode' GROUP BY kwitansi.jenis");
        return view('cetak.rkk', compact('dataRkk', 'kwitansi', 'kas'));
    }

    public function cetakVoucher()
    {
        $kode = request('kode');
        $kwitansi = Kwitansi::where('kode_kas', $kode)->orderBy('tgl', 'desc')->first();
        $kas = Kas::where('kode', $kode)->first();
        $dataRkk =  DB::select("select jenis_kwitansi.jenis as penjelasan, sum(kwitansi.jumlah) as jumlah from kwitansi, jenis_kwitansi 
        where jenis_kwitansi.id=kwitansi.jenis AND kode_kas='$kode' GROUP BY kwitansi.jenis");
        return view('cetak.voucher', compact('dataRkk', 'kwitansi', 'kas'));
    }
    public function create()
    {
        $uang = Saldo::orderBy('id', 'desc')->orderBy('created_at', 'desc')->first();
        $kk = Kas::orderBy('created_at', 'desc')->first();
        $maxno = Kas::max('no');
        $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $generateNomor = '/KWITANSI/' . $bulanRomawi[date("n")] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;
        $action = 'add';
        $pegawais = Pegawai::all();
        $kas = User::first();
        return view('pages.kas.create', compact('action', 'pegawais', 'kas', 'kode', 'uang', 'kk'));
    }

    public function getKwitansiAll()
    {
        $tmp = KasTmp::select("kode")->get();
        return Kwitansi::with('kwitansis')->where('status', 0)->whereNotIn('kode', $tmp)->orderBy('tgl', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $maxno = Kas::max('no');
        $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $generateNomor = '/KAS/' . $bulanRomawi[date("n")] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;

        $jumlah = 0;

        $uang = Saldo::orderBy('id', 'desc')->orderBy('created_at', 'desc')->first();
        $kk = Kas::orderBy('id', 'desc')->orderBy('created_at', 'desc')->first();

        foreach ($request->kwitansi as $dt) {
            $jumlah += $dt['jumlah'];
            Kwitansi::where('kode', $dt['kode'])->update(['status' => 1, 'kode_kas' => $kode]);
            KasTmp::where('kode', $dt['kode'])->delete();
        }
        Kas::create([
            "no" => ($maxno + 1),
            "kode" => $kode,
            "user" => Auth::user()->nama,
            "jumlah" => $jumlah,
            "tgl" => date('Y-m-d'),
        ]);
        Saldo::create([
            "saldo" => $uang->saldo - (isset($kk) ? $kk->jumlah : 0),
            "pengisian" => $request->pengisian,
            "kode_kas" => $kode
        ]);
        return $request;
    }

    public function getSelectedKas(Request $request)
    {
        return $kas = Kas::where('kode', $request->kode)->with('kwitansi', 'kwitansi.kwitansis')->first();
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function show($kas)
    {
        $kas = Kas::where('id', $kas)->firstOrFail();
        // return $kas;
        return view('pages.kas.edit', compact('kas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function edit($kas)
    {
        $uang = Saldo::orderBy('id', 'desc')->orderBy('created_at', 'desc')->first();
        $kas = Kas::where('id', $kas)->with(['kwitansi' => function ($q) {
            $q->orderBy('tgl');
        }])->first();
        return view('cetak.kas', compact('kas', 'uang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kas $kas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kas $kas)
    {
        //
    }
    public function edits(Request $request)
    {
        $selectedBefore = Kwitansi::where('kode_kas', $request->kode)->get();
        foreach ($selectedBefore as $dt) {
            Kwitansi::where('kode', $dt['kode'])->update(["status" => 0, "kode_kas" => null]);
        }
        $jumlah = 0;
        $kode = $request->kode;
        foreach ($request->kwitansi as $dt) {
            $jumlah += $dt['jumlah'];
            Kwitansi::where('kode', $dt['kode'])->update(['status' => 1, 'kode_kas' => $kode]);
            KasTmp::where('kode', $dt['kode'])->delete();
        }
        Kas::where('kode', $kode)->update([
            "user" => Auth::user()->nama,
            "jumlah" => $jumlah,
            "tgl" => date('Y-m-d'),
        ]);
        return $request;
    }
    public function delete(Request $request)
    {

        Kwitansi::where('kode_kas', $request->kode)->update(['status' => 0, 'kode_kas' => null]);
        Kas::where('kode', $request->kode)->delete();
        Saldo::where('kode_kas', $request->kode)->delete();
        return $request;
    }
}
