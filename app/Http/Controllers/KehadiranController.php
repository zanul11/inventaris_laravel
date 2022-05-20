<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Absen');
        $request->session()->put('child', 'Kehadiran');

        $firstDate = date('Y-m-') . '1';
        $endDate = date('Y-m-d');
        $tgl  = '01' . date('-m-Y') . ' s/d ' . date('d-m-Y');
        $kehadiran = Absen::with('pegawai')->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->orderby('tgl')->get();

        return view('pages.kehadiran.index', compact('kehadiran', 'tgl', 'firstDate', 'endDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        $pegawai = Pegawai::orderby('nama')->get();
        return view('pages.kehadiran.create', compact('action', 'pegawai'));
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
        Absen::create([
            "pegawai_id" => $request->pegawai_id,
            "tgl" => date('Y-m-d H:i:s', strtotime($request->waktu)),
            "jenis" => $request->jenis,
            "ket" => $request->ket
        ]);
        Alert::success('Success!', 'Berhasil Absen!');
        return Redirect::to('/kehadiran');
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
        $tgl = $request->tgl;
        $rep_date = str_replace(" ", "", $request->tgl);
        $exp_date = explode("s/d", $rep_date);
        $firstDate = date('Y-m-d', strtotime($exp_date[0]));
        $endDate = date('Y-m-d', strtotime($exp_date[1]));
        $kehadiran = Absen::with('pegawai')->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->orderby('tgl')->get();
        return view('pages.kehadiran.index', compact('kehadiran', 'tgl', 'firstDate', 'endDate'));
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
