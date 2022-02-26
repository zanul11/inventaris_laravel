<?php

namespace App\Http\Controllers;

use App\Kwitansi;
use App\KwitansiDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Pegawai;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Session;

class KwitansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Kas Kecil');
        $request->session()->put('child', 'Kwitansi Pembayaran');
        $total = Kwitansi::where('status', 0)->sum('jumlah');
        // return $barang = Kwitansi::with('pegawai')->with('jenis_det')->where('status', 0)->orderBy('created_at')->get();
        return view('pages.kwitansi.index', compact('total'));
    }

    public function getServerSide()
    {
        $barang = Kwitansi::with('pegawai')->with('jenis_det')->where('status', 0)->orderBy('created_at', 'desc')->get();
        return Datatables::of($barang)
            ->addIndexColumn()
            ->addColumn('tgl_input', function ($row) {
                return $row->created_at->format('d/m/Y');
            })
            ->addColumn('tgl', function ($row) {
                return $row->tgl->format('d/m/Y');
            })
            ->addColumn('daftar_barang', function ($row) {
                $tmp = '';
                if (count($row->kwitansis) < 2) {
                    foreach ($row->kwitansis as $dt) {
                        $tmp .= $dt['ket'] . ' ( Rp. ' . number_format($dt['harga']) . ' )';
                    }
                } else {
                    foreach ($row->kwitansis as $dt) {
                        $tmp .= $dt['ket'] . ' ( Rp. ' . number_format($dt['harga']) . ' ) |';
                    }
                }

                return $tmp;
            })
            ->addColumn('harga', function ($row) {
                return number_format($row->jumlah);
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a href="/kwitansi/' . $row->id . '" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
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
        $total = Kwitansi::where('status', 0)->sum('jumlah');
        if ($total > 60900000) {
            Alert::warning('Peringatan!', 'Kwitansi sudah lebih dari 60.800.000!');
            return Redirect::to('/kwitansi');
        }
        $maxno = Kwitansi::max('no');
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
        $kwitansi = User::first();
        return view('pages.kwitansi.create', compact('action', 'pegawais', 'kwitansi', 'kode'));
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
        $maxno = Kwitansi::max('no');
        $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $generateNomor = '/KWITANSI/' . $bulanRomawi[date("n")] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;

        foreach ($request->kwitansi as $dt) {
            KwitansiDetail::create([
                "kode" => $kode,
                "ket" => $dt['ket'],
                "harga" => $dt['harga'],
            ]);
        }
        Kwitansi::create([
            "no" => ($maxno + 1),
            "kode" => $kode,
            "ket" => 'Pembayaran',
            "jumlah" => $request->total,
            "pj" => $request->pegawai,
            "bidang" => $request->diterima,
            "user" => Auth::user()->nama,
            "tgl" => date('Y-m-d', strtotime($request->tgl . ' +1 day')),
            "jenis" => $request->jenis
        ]);
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function show(Kwitansi $kwitansi)
    {
        return view('pages.kwitansi.edit', compact('kwitansi'));
        return $kwitansi;
    }

    public function getSelectedBarang(Request $request)
    {
        $det = DB::table('kwitansi_det')
            ->join('kwitansi', 'kwitansi_det.kode', '=', 'kwitansi.kode')
            ->select('kwitansi_det.*', 'kwitansi.jumlah')
            ->where('kwitansi.kode', $request->kode)
            ->get();
        // $details = DetailBarangKeluar::where('log_kode', $request->kode)->with('barang', 'satuan_detail')->get();
        return $det;
    }

    public function edits(Request $request)
    {
        //DELETE DETAIL KWITANSI
        KwitansiDetail::where('kode', $request->kode)->delete();

        foreach ($request->kwitansi as $dt) {
            KwitansiDetail::create([
                "kode" => $request->kode,
                "ket" => $dt['ket'],
                "harga" => $dt['harga'],
            ]);
        }
        Kwitansi::where('kode', $request->kode)
            ->update([
                "jumlah" => $request->total,
                "pj" => $request->pegawai,
                "bidang" => $request->diterima,
                "user" => Auth::user()->nama,
                "tgl" => date('Y-m-d', strtotime($request->tgl)),
                "jenis" => $request->jenis
            ]);

        return $request;
    }

    public function cetak()
    {
        $kwitansi = Kwitansi::with('kwitansis')->with('pegawai')->with('jenis_det')->where('status', 0)->orderBy('created_at')->get();
        return view('cetak.kwitansi', compact('kwitansi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kwitansi $kwitansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kwitansi $kwitansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kwitansi $kwitansi)
    {
        //
    }

    public function delete(Kwitansi $kwitansi)
    {

        DB::table('kwitansi')
            ->where('kode', $kwitansi->kode)
            ->delete();
        DB::table('kwitansi_det')
            ->where('kode', $kwitansi->kode)
            ->delete();
    }
}
