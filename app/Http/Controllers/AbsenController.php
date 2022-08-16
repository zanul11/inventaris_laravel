<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::where('is_absen', 1)->orderby('nama')->get();
        return view('pages.absen.index', compact('pegawai'));
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
        $cek = Pegawai::where('id', $request->pegawai)->where('pin', $request->pin)->first();
        if (!$cek) {
            Alert::warning('Warning!', 'PIN ANDA SALAH!');
            return Redirect::to('/absen');
        } else {
            $date = getdate();
            $jam = $date['hours'];
            Absen::create([
                "pegawai_id" => $request->pegawai,
                "tgl" => date('Y-m-d H:i:s'),
                "jenis" => ($jam <= 12) ? 1 : 0
            ]);
            Alert::success('Success!', 'Berhasil Absen!');
            return Redirect::to('/absen');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absen $absen)
    {
        //
    }
}
