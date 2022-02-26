<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangMasuk;
use App\DetailBarangKeluar;
use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Laporan');
        $request->session()->put('child', 'Rekap Barang');
        $jenis = Jenis::orderby('jenis')->get();
        $array_barang = array();
        Session::put('jenis_barang', '');
        return view('pages.laporan.index', compact('jenis', 'array_barang'));
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
        Session::put('jenis_barang', $request->jenis);
        $jenis = Jenis::orderby('jenis')->get();
        // return $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', 38)->sum('jumlah');
        // return $request;
        if ($request->jenis == 'semua') {
            $array_barang = [];
            $data = Jenis::all();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->sum('jumlah');
                    $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->sum('jumlah');
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                        'log_keluar' => $log_keluar
                    ]);
                }


                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
            // return $array_barang;
            return view('pages.laporan.index', compact('array_barang', 'jenis'));
        } else {
            $array_barang = [];
            $data = Jenis::where('id', $request->jenis)->get();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->sum('jumlah');
                    $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->sum('jumlah');
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                        'log_keluar' => $log_keluar
                    ]);
                }


                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
            // return $array_barang;
            return view('pages.laporan.index', compact('array_barang', 'jenis'));
        }
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
        // return $request;
        if ($request->jenis == 'semua' || $request->jenis == null) {
            $array_barang = [];
            $data = Jenis::all();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->sum('jumlah');
                    $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->sum('jumlah');
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                        'log_keluar' => $log_keluar
                    ]);
                }


                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
            // return $array_barang;
            return view('cetak.barang', compact('array_barang'));
        } else {
            $array_barang = [];
            $data = Jenis::where('id', $request->jenis)->get();

            foreach ($data as $dt) {
                $log = [];
                $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                foreach ($barang as $dt_brg) {
                    $tmp_log_masuk_keluar = [];
                    $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->sum('jumlah');
                    $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->sum('jumlah');
                    array_push($log, (object) [
                        'detail' => $dt_brg,
                        'log_masuk' => $log_masuk,
                        'log_keluar' => $log_keluar
                    ]);
                }


                array_push($array_barang, (object) [
                    'jenis' => $dt['jenis'],
                    'barang' => $log,
                ]);
            }
            // return $array_barang;
            return view('cetak.barang', compact('array_barang'));
        }
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
