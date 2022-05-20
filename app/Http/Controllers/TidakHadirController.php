<?php

namespace App\Http\Controllers;

use App\JenisIzin;
use App\Pegawai;
use App\TidakHadir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class TidakHadirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Absen');
        $request->session()->put('child', 'Tidak Hadir');

        $firstDate = date('Y-m-') . '1';
        $endDate = date('Y-m-d');
        $tgl  = '01' . date('-m-Y') . ' s/d ' . date('d-m-Y');

        $data = TidakHadir::with('pegawai')->with('jenis')->whereDate('tgl_mulai', '>=', $firstDate)->OrwhereDate('tgl_akhir', '<=', $endDate)->orderby('tgl_mulai')->get();

        return view('pages.tidak_hadir.index', compact('data', 'tgl', 'firstDate', 'endDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Pegawai::orderby('nama')->get();
        $jenis = JenisIzin::get();
        return view('pages.tidak_hadir.create', compact('jenis', 'pegawai'));
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
        $rep_date = str_replace(" ", "", $request->waktu);
        $exp_date = explode("s/d", $rep_date);
        TidakHadir::create([
            "pegawai_id" => $request->pegawai_id,
            'tgl_mulai' => date('Y-m-d', strtotime($exp_date[0])),
            'tgl_akhir' => date('Y-m-d', strtotime($exp_date[1])),
            "jenis_id" => $request->jenis,
            "ket" => $request->ket
        ]);
        Alert::success('Success!', 'Berhasil Tambah Data!');
        return Redirect::to('/tidak_hadir');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TidakHadir  $tidakHadir
     * @return \Illuminate\Http\Response
     */
    public function show(TidakHadir $tidakHadir)
    {
        return $tidakHadir;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TidakHadir  $tidakHadir
     * @return \Illuminate\Http\Response
     */
    public function edit(TidakHadir $tidakHadir)
    {
        //
    }

    public function filter(Request $request)
    {

        $tgl = $request->tgl;
        $rep_date = str_replace(" ", "", $request->tgl);
        $exp_date = explode("s/d", $rep_date);
        $firstDate = date('Y-m-d', strtotime($exp_date[0]));
        $endDate = date('Y-m-d', strtotime($exp_date[1]));
        $data = TidakHadir::with('pegawai')->with('jenis')->whereDate('tgl_mulai', '>=', $firstDate)->OrwhereDate('tgl_akhir', '<=', $endDate)->orderby('tgl_mulai')->get();
        return view('pages.tidak_hadir.index', compact('data', 'tgl', 'firstDate', 'endDate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TidakHadir  $tidakHadir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TidakHadir $tidakHadir)
    {
        return $request;
        $tgl = $request->tgl;
        $rep_date = str_replace(" ", "", $request->tgl);
        $exp_date = explode("s/d", $rep_date);
        $firstDate = date('Y-m-d', strtotime($exp_date[0]));
        $endDate = date('Y-m-d', strtotime($exp_date[1]));
        $data = TidakHadir::with('pegawai')->with('jenis')->whereDate('tgl_mulai', '>=', $firstDate)->OrwhereDate('tgl_akhir', '<=', $endDate)->orderby('tgl_mulai')->get();
        return view('pages.tidak_hadir.index', compact('data', 'tgl', 'firstDate', 'endDate'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TidakHadir  $tidakHadir
     * @return \Illuminate\Http\Response
     */
    public function destroy(TidakHadir $tidakHadir)
    {
        //
    }
}
