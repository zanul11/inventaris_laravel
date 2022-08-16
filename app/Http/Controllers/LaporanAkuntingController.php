<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class LaporanAkuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $request->session()->put('parent', 'Keuangan');
        $request->session()->put('child', 'Laporan Keuangan');

        $request->session()->put('dTgl', date('Y-m-d'));
        $request->session()->put('sTgl', date('Y-m-d'));
        $request->session()->put('jenis', 'Semua');
        $request->session()->put('cari', '');


        return view('pages.laporan_akunting.index');
    }

    public function getServerSide()
    {
        if (Session::get('jenis') == 'Semua') {
            $jenis = [1, 0];
        } else if (Session::get('jenis') == 'Pemasukan') {
            $jenis = [1];
        } else {
            $jenis = [0];
        }
        $dTgl = Session::get('dTgl');
        $sTgl = Session::get('sTgl');
        $cari = Session::get('cari');
        if ($cari == '')
            $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('status', 1)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 1)->orderby('created_at')->get();
        else
            $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('status', 1)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 1)->where('nama', 'like', '%' . $cari . '%')
                ->orderby('created_at')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uang_masuk', function ($row) {
                return ($row->jenis == 1) ? number_format($row->jumlah) : '0';
            })->addColumn('uang_keluar', function ($row) {
                return ($row->jenis == 0) ? number_format($row->jumlah) : '0';
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->put('dTgl', $request->dTgl);
        $request->session()->put('sTgl', $request->sTgl);
        $request->session()->put('jenis', $request->jenis);
        $request->session()->put('cari', $request->cari);


        return view('pages.laporan_akunting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (Session::get('jenis') == 'Semua') {
            $jenis = [1, 0];
        } else if (Session::get('jenis') == 'Pemasukan') {
            $jenis = [1];
        } else {
            $jenis = [0];
        }
        $jenis_keuangan = Session::get('jenis');
        $dTgl = Session::get('dTgl');
        $sTgl = Session::get('sTgl');
        $cari = Session::get('cari');
        if ($cari == '')
            $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('status', 1)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 1)->orderby('created_at')->get();
        else
            $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('status', 1)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 1)->where('nama', 'like', '%' . $cari . '%')
                ->orderby('created_at')->get();

        return view('pages.laporan_akunting.cetak', compact('dTgl', 'sTgl', 'jenis_keuangan', 'cari', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
