<?php

namespace App\Http\Controllers\Bantuan;

use App\Http\Controllers\Controller;
use App\ModelBantuan\M_Pelanggan;
use App\ModelBantuan\Pelanggan;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Bantuan');
        $request->session()->put('child', 'Pelanggan');
        // return Pelanggan::with('detail')->with('pembayaran')->get();
        return view('pages.bantuan.pelanggan.index');
    }



    public function getServerSide()
    {
        $pelanggan = Pelanggan::with('detail')->with('pembayaran')->get();
        return Datatables::of($pelanggan)
            ->addIndexColumn()
            ->addColumn('sisa_saldo', function ($row) {
                $tmpPembayaran = 0;
                foreach ($row->pembayaran as $dt) {
                    $tmpPembayaran += $dt['total'];
                }
                return $row->saldo - $tmpPembayaran;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a href="/pelanggan/' . $row->id . '/edit" class="btn btn-primary" style="font-size:12px; color:white;">Lihat Data</a>
                <button id="" class="btn btn-white dropdown-toggle" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                    <a onclick="btnDelete(' . $row->id . ')" class="dropdown-item"> Hapus</a>
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
    public function create()
    {
        $action = 'add';
        $pelanggan = User::first();
        return view('pages.bantuan.pelanggan.create', compact('action', 'pelanggan'));
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

        $pelanggan = M_Pelanggan::where('pelanggan_ID', $request->pelanggan_id)->first();
        $cekPelanggan = Pelanggan::where('pelanggan_ID', $request->pelanggan_id)->get();
        if (count($cekPelanggan) > 0) {
            Alert::warning('Warning!', 'Duplicate Pelanggan');
            return Redirect::to('/pelanggan/create')->withErrors(['Nama pelanggan telah terdaftar.'])->withInput();
        } else {
            Pelanggan::create([
                "pelanggan_ID" => $request->pelanggan_id,
                "pelanggan_nama" => $pelanggan->pelanggan_nama,
            ]);
            Alert::success('Success!', 'Data Pelanggan Added!');
            return Redirect::to('/pelanggan');
        }
        // return $pelanggan->pelanggan_nama;
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
        $pelanggan = Pelanggan::where('id', $id)->with('detail')->with('pembayaran')->first();
        $tagihan = DB::select(DB::raw("select cBlth bulan, nStIni-nStLalu m3, nStIni stand, nHrgAir harga_air, nByAdm admin, nByRetrib retrib, nByMaterai materai, 
        CASE WHEN DATE(now())>CONCAT(YEAR(rekening_periode),'-', CASE WHEN DATE_FORMAT(rekening_periode,'%m')+1<10 THEN CONCAT('0',DATE_FORMAT(rekening_periode,'%m')+1)
        ELSE DATE_FORMAT(rekening_periode,'%m')+1 END,'-', 25) THEN 10000 ELSE 0 END denda, dTglBayar lunas, cKasir kasir, cKetWM ket
          from rekening.m_rekening where cIdpel='$pelanggan->pelanggan_ID' and lBayar=0"));

        return view('pages.bantuan.pelanggan.detail', compact('pelanggan', 'tagihan'));
        return $id;
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

    public function delete(Pelanggan $pelanggan)
    {
        // return $pelanggan;
        DB::table('pelanggan')
            ->where('id', $pelanggan->id)
            ->delete();
    }
}
