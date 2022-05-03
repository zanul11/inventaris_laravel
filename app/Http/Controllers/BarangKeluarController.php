<?php

namespace App\Http\Controllers;

use App\BarangMasuk;
use Illuminate\Http\Request;
use App\Barang;
use App\BarangKeluar;
use App\DetailBarangKeluar;
use App\Jenis;
use App\Pegawai;
use App\Satuan;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Yajra\DataTables\DataTables;


class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //tes
        $request->session()->put('parent', 'Manajemen Barang');
        $request->session()->put('child', 'Barang Keluar');

        return view('pages.barang_keluar.index');
    }

    public function getServerSide()
    {

        $barang = BarangKeluar::where('jenis', 0)->with('barangs')->orderBy('created_at', 'desc')->get();

        return Datatables::of($barang)
            ->addIndexColumn()
            ->addColumn('tgls', function ($row) {
                return $row->tgl->format('d/m/Y');
            })
            ->addColumn('penerima', function ($row) {
                return $row->pj;
            })
            ->addColumn('daftar_barang', function ($row) {
                $tmp = '';
                if (count($row->barangs) < 2) {
                    foreach ($row->barangs as $dt) {
                        $tmp .= $dt['barang']->nama . ' (' . $dt['jumlah'] . ') ';
                    }
                } else {
                    foreach ($row->barangs as $dt) {
                        $tmp .= $dt['barang']->nama . ' (' . $dt['jumlah'] . ') |';
                    }
                }

                return $tmp;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a href="/barang_keluar/' . $row->id . '" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
                <a href="/barang_keluar/cetak/' . $row->id . '" target="_blank" class="btn btn-primary" style="font-size:12px; color:white;">Cetak</a>
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
    public function create()
    {
        $maxno = BarangMasuk::where('jenis', 0)->max('no');
        $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $generateNomor = '/INV.BRG.KLR/' . $bulanRomawi[date("n")] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;
        $action = 'add';

        $barang_keluar = User::first();
        $barang = Barang::whereNull('deleted_at')->get();
        return view('pages.barang_keluar.create', compact('action', 'barang_keluar', 'kode', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maxno = BarangMasuk::where('jenis', 0)->max('no');
        $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $generateNomor = '/INV.BRG.KLR/' . $bulanRomawi[date("n")] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;

        $jum_stok = 0;
        foreach ($request->barangs as $dt) {
            $jum_stok = 0;
            $barang = Barang::where('id', $dt['barang_id'])->first();
            $sisa = ($barang['stok'] - $dt['jumlah']);
            DB::table('barang')
                ->where('id', $dt['barang_id'])
                ->update(['stok' => $sisa]);
            DetailBarangKeluar::create([
                "log_kode" => $kode,
                "barang_id" => $dt['barang_id'],
                "jumlah" => $dt['jumlah'],
                "ket" => $request->ket,
                "sisa" => $sisa,
                "tgl" => date('Y-m-d', strtotime($request->tgl . ' +1 day'))
            ]);
            $jum_stok += $dt['jumlah'];
        }
        BarangKeluar::create([
            "no" => ($maxno + 1),
            "kode" => $kode,
            "barang_id" => null,
            "diterima" => $request->diterima,
            "jumlah" => $jum_stok,
            "pj" => $request->pj,
            "user" => Auth::user()->nama,
            "jenis" => 0,
            "stok" => 0,
            "ket" => 'Barang keluar',
            "tgl" => date('Y-m-d', strtotime($request->tgl . ' +1 day')),
        ]);
        return $request;
    }

    public function getBarang()
    {
        $barang = Barang::with('satuan_detail')->whereNull('deleted_at')->get();
        return $barang;
    }

    public function getSelectedBarang(Request $request)
    {

        $det = DB::table('detail_barang_keluar')
            ->join('barang', 'detail_barang_keluar.barang_id', '=', 'barang.id')
            ->join('satuan', 'satuan.id', '=', 'barang.satuan')
            ->select('detail_barang_keluar.*', 'barang.nama', 'satuan.satuan', 'satuan.id as satuan_id')
            ->where('detail_barang_keluar.log_kode', $request->kode)
            ->get();
        // $details = DetailBarangKeluar::where('log_kode', $request->kode)->with('barang', 'satuan_detail')->get();
        return $det;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(BarangKeluar $barangKeluar)
    {
        return view('pages.barang_keluar.edit', compact('barangKeluar'));
        return $barangKeluar;
    }

    public function cetak(BarangKeluar $barang)
    {
        return view('cetak.permintaan', compact('barang'));
        return $barang;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }
    public function edits(Request $request)
    {
        //UPDATE BARANG KELUAR AFTER EDIT
        $tmp = DetailBarangKeluar::where('log_kode', $request->kode)->get();
        foreach ($tmp as $dt) {
            $barang = Barang::where('id', $dt['barang_id'])->first();
            $return_stok = ($barang['stok'] + $dt['jumlah']);
            DB::table('barang')
                ->where('id', $dt['barang_id'])
                ->update(['stok' => $return_stok]);
            DB::table('detail_barang_keluar')
                ->where('barang_id', $dt['barang_id'])
                ->where('log_kode', $request->kode)
                ->delete();
        }


        $jum_stok = 0;
        foreach ($request->barangs as $dt) {
            $jum_stok = 0;
            $barang = Barang::where('id', $dt['barang_id'])->first();
            $sisa = ($barang['stok'] - $dt['jumlah']);
            DB::table('barang')
                ->where('id', $dt['barang_id'])
                ->update(['stok' => $sisa]);
            DetailBarangKeluar::create([
                "log_kode" => $request->kode,
                "barang_id" => $dt['barang_id'],
                "jumlah" => $dt['jumlah'],
                "ket" => $dt['ket'],
                "sisa" => $sisa,
                "tgl" => date('Y-m-d', strtotime($request->tgl)),
            ]);
            $jum_stok += $dt['jumlah'];
        }

        BarangKeluar::where('kode', $request->kode)
            ->update([
                "diterima" => $request->diterima,
                "jumlah" => $jum_stok,
                "pj" => $request->pegawai,
                "user" => Auth::user()->nama,
                "tgl" => date('Y-m-d', strtotime($request->tgl)),
            ]);
        // BarangKeluar::create([
        //     "no" => ($maxno + 1),
        //     "kode" => $kode,
        //     "barang_id" => null,
        //     "diterima" => $request->diterima,
        //     "jumlah" => $jum_stok,
        //     "pj" => $request->pegawai,
        //     "user" => Auth::user()->nama,
        //     "jenis" => 0,
        //     "stok" => 0,
        //     "ket" => 'Barang keluar'
        // ]);
        return $request;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
    }

    public function delete(BarangKeluar $barang)
    {

        // return $barang->kode;
        foreach ($barang->barangs as $dt) {
            $brg = Barang::where('id', $dt['barang_id'])->first();
            $return_stok = ($brg['stok'] + $dt['jumlah']);
            DB::table('barang')
                ->where('id', $dt['barang_id'])
                ->update(['stok' => $return_stok]);
            DB::table('detail_barang_keluar')
                ->where('barang_id', $dt['barang_id'])
                ->where('log_kode', $barang->kode)
                ->delete();
        }
        DB::table('log_barang')
            ->where('kode', $barang->kode)
            ->delete();
        // $barang_stok = Barang::where('id', $barang->id)->first();
        // $log_barang_update = BarangMasuk::where('created_at', '>=', $barang->created_at)->where('jenis', 1)->get();
        // foreach ($log_barang_update as $dt) {
        //     DB::table('log_barang')
        //         ->where('id', $dt->id)
        //         ->update(['stok' => ($dt->stok - $barang->jumlah)]);
        // }
        // DB::table('barang')
        //     ->where('id', $barang->id)
        //     ->update(['stok' => ($barang_stok['stok'] - $barang->jumlah)]);
        // // return $barang;
        // $barang->delete();
    }
}
