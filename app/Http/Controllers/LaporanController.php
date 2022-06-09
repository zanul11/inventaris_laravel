<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangKeluar;
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

        $request->session()->put('parent', 'Manajemen Barang');
        $request->session()->put('child', 'Laporan');
        $jenis = Jenis::orderby('jenis')->get();
        $array_barang = array();
        Session::put('jenis_barang', '');
        Session::put('tahun', date('Y'));
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
        // return $request;
        Session::put('jenis_barang', $request->jenis);
        Session::put('bulan', $request->bulan);
        Session::put('tahun', $request->tahun);
        $jenis = Jenis::orderby('jenis')->get();
        // return $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', 38)->sum('jumlah');
        // return $request;
        $array_barang = [];

        if ($request->jenis == 'semua') {
            $data = Jenis::all();
            if ($request->bulan == 'semua') {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];
                        //hitung saldo awal
                        $request->tahun - 1;
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');

                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;

                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);
                    // return $array_barang;
                }
            } else {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];

                        //hitung saldo awal
                        $date = $request->tahun . '-' . $request->bulan . '-' . '1';
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;


                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'stok_awal' => $dt_brg->stok_awal,
                            'log_masuk_saldo' => $log_masuk_saldo,
                            'log_keluar_saldo' => $log_keluar_saldo,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);

                    // return $array_barang;
                }
            }
            // return $array_barang;
            return view('pages.laporan.index', compact('array_barang', 'jenis'));
        } else {
            $data = Jenis::where('id', $request->jenis)->get();

            if ($request->bulan == 'semua') {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];
                        //hitung saldo awal
                        $request->tahun - 1;
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');

                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;

                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);
                }
            } else {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];

                        //hitung saldo awal
                        $date = $request->tahun . '-' . $request->bulan . '-' . '1';
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;


                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'stok_awal' => $dt_brg->stok_awal,
                            'log_masuk_saldo' => $log_masuk_saldo,
                            'log_keluar_saldo' => $log_keluar_saldo,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);
                }
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
        $jenis = Jenis::orderby('jenis')->get();
        // return $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', 38)->sum('jumlah');
        $namaBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $array_barang = [];
        if ($request->bulan != 'semua')
            $ket_waktu = 'Per : ' . $namaBulan[$request->bulan] . ' ' . $request->tahun;
        else
            $ket_waktu = 'Tahun ' . $request->tahun;

        if ($request->jenis == 'semua' || $request->jenis == null) {
            $data = Jenis::all();
            if ($request->bulan == 'semua') {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];
                        //hitung saldo awal
                        $request->tahun - 1;
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');

                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;

                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);
                    // return $array_barang;
                }
            } else {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];

                        //hitung saldo awal
                        $date = $request->tahun . '-' . $request->bulan . '-' . '1';
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;


                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'stok_awal' => $dt_brg->stok_awal,
                            'log_masuk_saldo' => $log_masuk_saldo,
                            'log_keluar_saldo' => $log_keluar_saldo,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);

                    // return $array_barang;
                }
            }
            // return $array_barang;
            return view('cetak.barang', compact('array_barang', 'ket_waktu'));
        } else {
            $data = Jenis::where('id', $request->jenis)->get();


            if ($request->bulan == 'semua') {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];
                        //hitung saldo awal
                        $request->tahun - 1;
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', '<', $request->tahun)->sum('jumlah');

                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;

                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);
                }
            } else {
                foreach ($data as $dt) {
                    $log = [];
                    $barang = Barang::with('satuan_detail')->where('jenis', $dt['id'])->whereNull('deleted_at')->get();
                    foreach ($barang as $dt_brg) {
                        $tmp_log_masuk_keluar = [];

                        //hitung saldo awal
                        $date = $request->tahun . '-' . $request->bulan . '-' . '1';
                        $log_masuk_saldo = BarangMasuk::where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $log_keluar_saldo = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereDate('tgl', '<=', $date)->sum('jumlah');
                        $saldo_awal = $dt_brg->stok_awal + $log_masuk_saldo - $log_keluar_saldo;


                        $log_masuk = BarangMasuk::where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $dt_brg['id'])->whereMonth('tgl', $request->bulan)->whereYear('tgl', $request->tahun)->sum('jumlah');
                        array_push($log, (object) [
                            'detail' => $dt_brg,
                            'stok_awal' => $dt_brg->stok_awal,
                            'log_masuk_saldo' => $log_masuk_saldo,
                            'log_keluar_saldo' => $log_keluar_saldo,
                            'saldo_awal' => $saldo_awal,
                            'log_masuk' => $log_masuk,
                            'log_keluar' => $log_keluar
                        ]);
                    }
                    array_push($array_barang, (object) [
                        'jenis' => $dt['jenis'],
                        'barang' => $log,
                    ]);
                }
            }

            // return $array_barang;
            return view('cetak.barang', compact('array_barang', 'ket_waktu'));
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
