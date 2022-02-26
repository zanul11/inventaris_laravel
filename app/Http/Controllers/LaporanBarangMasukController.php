<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangMasuk;
use App\DetailBarangKeluar;
use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Laporan');
        $request->session()->put('child', 'Laporan Barang Masuk');
        $jenis = Jenis::orderby('jenis')->get();
        $array_barang = array();
        Session::put('dTgl', date('Y-m-d'));
        Session::put('sTgl', date('Y-m-d'));
        Session::put('jenis_barang', '');
        return view('pages.laporan.barang_masuk', compact('jenis', 'array_barang'));
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
        // return $request;
        Session::put('jenis_barang', $request->jenis);
        Session::put('dTgl', date('Y-m-d', strtotime($request->dtgl)));
        Session::put('sTgl', date('Y-m-d', strtotime($request->stgl)));
        $jenis = Jenis::orderby('jenis')->get();

        if ($request->jenis == 'semua') {
            $array_barang = [];
            $data = Jenis::all();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->where('jenis', 1)->whereBetween('tgl', [$request->dtgl, $request->stgl])->get();
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                    ]);
                }
                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
        } else {
            $array_barang = [];
            $data = Jenis::where('id', $request->jenis)->get();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->where('jenis', 1)->whereBetween('tgl', [$request->dtgl, $request->stgl])->get();
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                    ]);
                }
                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
        }

        // return $array_barang;
        return view('pages.laporan.barang_masuk', compact('jenis', 'array_barang'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $jenis = Jenis::orderby('jenis')->get();
        $ket_waktu = date('d-m-Y', strtotime($request->dtgl)) . ' s.d ' . date('d-m-Y', strtotime($request->stgl));


        if ($request->jenis == 'semua') {
            $array_barang = [];
            $data = Jenis::all();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->where('jenis', 1)->whereBetween('tgl', [$request->dtgl, $request->stgl])->get();
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                    ]);
                }
                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
        } else {
            $array_barang = [];
            $data = Jenis::where('id', $request->jenis)->get();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->where('jenis', 1)->whereBetween('tgl', [$request->dtgl, $request->stgl])->get();
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                    ]);
                }
                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
        }

        // return $array_barang;
        return view('cetak.laporan_barang_masuk', compact('jenis', 'array_barang', 'ket_waktu'));
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
