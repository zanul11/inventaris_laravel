<?php

namespace App\Http\Controllers;

use App\JenisAkunting;
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
        $request->session()->put('kelompok', '');
        $request->session()->put('cari', '');


        // $dTgl = Session::get('dTgl');
        // $sTgl = Session::get('sTgl');
        // $cari = Session::get('cari');
        // $kelompok = Session::get('kelompok');
        // if (Session::get('jenis') == 'Semua') {
        //     $jenis = [1, 0];
        // } else if (Session::get('jenis') == 'Pemasukan') {
        //     $jenis = [1];
        // } else {
        //     $jenis = [0];
        // }
        // if (Session::get('kelompok') == '')
        //     return  $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('status', 4)->orderby('created_at')->get();
        // else
        //     return  $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('jenis_akunting_id', $kelompok)->where('status', 4)->orderby('created_at')->get();

        $jenis_akunting = JenisAkunting::orderby('jenis')->get();
        return view('pages.laporan_akunting.index', compact('jenis_akunting'));
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
        $kelompok = Session::get('kelompok');
        if ($cari == '') {
            if ($kelompok == '')
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->orderby('created_at')->get();
            else
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('jenis_akunting_id', $kelompok)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->orderby('created_at')->get();
        } else {
            if ($kelompok == '') {
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->where('nama', 'like', '%' . $cari . '%')
                    ->orderby('created_at')->get();
            } else {
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('jenis_akunting_id', $kelompok)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->where('nama', 'like', '%' . $cari . '%')
                    ->orderby('created_at')->get();
            }
        }


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
        $request->session()->put('kelompok', $request->kelompok);

        // return $request->sTgl . $request->sTgl . ' ' . $request->jenis . ' ' . $request->cari . ' ' . $request->kelompok;

        $jenis_akunting = JenisAkunting::orderby('jenis')->get();
        return view('pages.laporan_akunting.index', compact('jenis_akunting'));
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
        $kelompok = Session::get('kelompok');

        $nm_kelompok = ($kelompok == '') ? 'Semua' : JenisAkunting::where('id', $kelompok)->first()->jenis;
        if ($cari == '') {
            if ($kelompok == '')
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->orderby('created_at')->get();
            else
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('jenis_akunting_id', $kelompok)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->orderby('created_at')->get();
        } else {
            if ($kelompok == '') {
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->where('nama', 'like', '%' . $cari . '%')
                    ->orderby('created_at')->get();
            } else {
                $data = Pengeluaran::with('jenis_akunting')->whereIN('jenis', $jenis)->where('jenis_akunting_id', $kelompok)->whereBetween('tgl', [$dTgl, $sTgl])->where('status', 4)->where('nama', 'like', '%' . $cari . '%')
                    ->orderby('created_at')->get();
            }
        }

        return view('pages.laporan_akunting.cetak', compact('dTgl', 'sTgl', 'jenis_keuangan', 'cari', 'data', 'nm_kelompok'));
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
