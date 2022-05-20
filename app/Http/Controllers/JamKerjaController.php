<?php

namespace App\Http\Controllers;

use App\JamKerja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class JamKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Absen');
        $request->session()->put('child', 'Jam Kerja');
        $data = JamKerja::orderby('hari')->get();
        return view('pages.jam_kerja.index', compact('data'));
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
        // return date('H:i', strtotime('15:00') - $request->toleransi_pulang[0] * 60);
        JamKerja::truncate();
        try {
            for ($i = 0; $i < 7; $i++) {
                JamKerja::create([
                    'hari' => $request->hari[$i],
                    'status' => $request->status[$i],
                    'masuk' => $request->masuk[$i],
                    'pulang' => $request->pulang[$i],
                    'toleransi_masuk' => $request->toleransi_masuk[$i],
                    'toleransi_pulang' => $request->toleransi_pulang[$i],
                    'jam_masuk' => date('H:i', strtotime($request->masuk[$i]) + $request->toleransi_masuk[$i] * 60),
                    'jam_pulang' => date('H:i', strtotime($request->pulang[$i]) - $request->toleransi_pulang[$i] * 60)
                ]);
            }
            alert()->success('Berhasil Tambah Jam Kerja!');
            return Redirect::to('/jam-kerja');
        } catch (\Throwable $th) {

            alert()->error('Oppss !!', $th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JamKerja  $jamKerja
     * @return \Illuminate\Http\Response
     */
    public function show(JamKerja $jamKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JamKerja  $jamKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(JamKerja $jamKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JamKerja  $jamKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JamKerja $jamKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JamKerja  $jamKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(JamKerja $jamKerja)
    {
        //
    }
}
