<?php

namespace App\Http\Controllers\Bantuan;

use App\Http\Controllers\Controller;
use App\ModelBantuan\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Bantuan');
        $request->session()->put('child', 'Pembayaran Rekening');

        return view('pages.bantuan.pembayaran.index');
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
        foreach ($request->tagihan as $dt) {
            $cek = Pembayaran::where('cBlth', $dt['bulan'])->where('pelanggan_ID', $request->pelanggan_ID)->get();
            if (count($cek) > 0) {
                Pembayaran::where('cBlth', $dt['bulan'])->where('pelanggan_ID', $request->pelanggan_ID)->delete();
            }
            Pembayaran::create([
                "pelanggan_ID" => $request->pelanggan_ID,
                "cBlth" => $dt['bulan'],
                "total" => $dt['total'],
                "tagihan" => $dt['tagihan'],
                "admin" => $dt['admin'],
                "denda" => $dt['denda'],
                "lingkungan" => $dt['lingkungan'],
                "materai" => $dt['materai'],
                "retrib" => $dt['retrib'],
                "m3" => $dt['m3'],
                "stand" => $dt['stand'],
                "user" => Auth::user()->nama
            ]);
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
