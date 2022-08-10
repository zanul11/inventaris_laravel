<?php

namespace App\Http\Controllers;

use App\BarangMasuk;
use Illuminate\Http\Request;
use App\Barang;
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

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Manajemen Barang');
        $request->session()->put('child', 'Barang Masuk');

        $barang = Barang::whereNull('deleted_at')->get();

        return view('pages.barang_masuk.index', compact('barang'));
    }

    public function getServerSide()
    {


        $barang = BarangMasuk::where('jenis', 1)->with('barang')->where('jenis', 1)->orderBy('created_at', 'desc')->get();
        return Datatables::of($barang)
            ->addIndexColumn()
            ->addColumn('tgl', function ($row) {
                return $row->tgl->format('d/m/Y');
            })
            ->addColumn('name', function ($row) {
                return $row->barang->nama  . ' - ' . $row->barang->merk;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="showModalsEdit(' . $row->id . ',\'' . $row->barang_id . '\',' . $row->jumlah . ',\'' . $row->pj . '\'' . ',\'' . $row->tgl->format('Y-m-d') . '\',\'' . $row->ket . '\')" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
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
        $barang = Barang::with('jenis_detail')->where('id', $request->barang)->first();
        $sisa_stok = ($barang['stok'] + $request->stok);
        $maxno = BarangMasuk::max('no');
        $generateNomor = '/INV.BRG.MSK/' . $barang['jenis_detail']['jenis'] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;
        // return $request;
        BarangMasuk::create([
            "no" => ($maxno + 1),
            "kode" => $kode,
            "barang_id" => $request->barang,
            "jumlah" => $request->stok,
            "pj" => $request->pegawai,
            "user" => Auth::user()->nama,
            "jenis" => 1,
            "stok" => $sisa_stok,
            "ket" => $request->ket,
            "tgl" => $request->tgl
        ]);
        DB::table('barang')
            ->where('id', $request->barang)
            ->update(['stok' => $sisa_stok]);
        Alert::success('Success!', 'Data Barang Masuk Added!');
        return Redirect::to('/barang_masuk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        //
    }

    public function edits(Request $request)
    {

        $barang_masuk = BarangMasuk::where('id', $request->id_barang_masuk)->first();
        $barang = Barang::where('id', $barang_masuk['barang_id'])->first();

        //log barang mana saja yang akan di update sisa stok ( > tgl input/created_at)
        $log_barang_update = BarangMasuk::where('jenis', 1)->where('created_at', '>=', $barang_masuk['created_at'])->get();
        //jika barang sama
        if ($request->barang_edit == $barang_masuk['barang_id']) {
            $stok_baru = $request->stok_edit - $barang_masuk['jumlah'];
            foreach ($log_barang_update as $dt) {
                DB::table('log_barang')
                    ->where('id', $dt->id)
                    ->update(['stok' => ($dt->stok + $stok_baru)]);
            }
            DB::table('barang')
                ->where('id', $barang_masuk['barang_id'])
                ->update(['stok' => ($barang['stok'] + $stok_baru)]);
            DB::table('log_barang')
                ->where('id', $request->id_barang_masuk)
                ->update(['jumlah' => $request->stok_edit, 'pj' => $request->pegawai_edit, 'ket' => $request->ket_edit, 'tgl' => $request->tgl_edit]);
        }
        Alert::success('Success!', 'Data Barang Masuk Updated!');
        return Redirect::to('/barang_masuk');
    }

    public function delete(BarangMasuk $barang)
    {

        $barang_stok = Barang::where('id', $barang->barang_id)->first();
        $log_barang_update = BarangMasuk::where('barang_id', $barang->barang_id)->where('created_at', '>=', $barang->created_at)->where('jenis', 1)->get();
        foreach ($log_barang_update as $dt) {
            DB::table('log_barang')
                ->where('id', $dt->id)
                ->update(['stok' => ($dt->stok - $barang->jumlah)]);
        }
        DB::table('barang')
            ->where('id', $barang->barang_id)
            ->update(['stok' => ($barang_stok['stok'] - $barang->jumlah)]);
        // return $barang;
        $barang->delete();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        //
    }
}
