<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Posting;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Laporan Absen');
        $request->session()->put('child', 'Rekap Absensi');

        $firstDate = date('Y-m-') . '1';
        $endDate = date('Y-m-d');
        $tgl  = '01' . date('-m-Y') . ' s/d ' . date('d-m-Y');

        $dataRekapAbsen = [];
        $pegawai = Pegawai::all();
        foreach ($pegawai as $peg) {
            $hariKerja = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk', '!=', 0)->count();
            $kehadiran = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk',  1)->count();
            $tanpaKet = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk',  3)->count();
            $izin = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk', 2)->count();
            $telat = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('telat', 1)->count();
            array_push($dataRekapAbsen, (object) [
                'no_identitas' => $peg->no_identitas,
                'nama' => $peg->nama,
                'hariKerja' => $hariKerja,
                'kehadiran' => $kehadiran,
                'tanpaKet' => $tanpaKet,
                'izin' => $izin,
                'telat' => $telat,
            ]);
        }
        return view('pages.rekap.index', compact('dataRekapAbsen', 'tgl', 'firstDate', 'endDate'));
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
        $tgl = $request->tgl;
        $rep_date = str_replace(" ", "", $request->tgl);
        $exp_date = explode("s/d", $rep_date);
        $firstDate = date('Y-m-d', strtotime($exp_date[0]));
        $endDate = date('Y-m-d', strtotime($exp_date[1]));

        $dataRekapAbsen = [];
        $pegawai = Pegawai::all();
        foreach ($pegawai as $peg) {
            $hariKerja = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk', '!=', 0)->count();
            $kehadiran = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk',  1)->count();
            $tanpaKet = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk',  3)->count();
            $izin = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('is_masuk', 2)->count();
            $telat = Posting::where('pegawai_id', $peg->id)->whereDate('tgl', '>=', $firstDate)->whereDate('tgl', '<=', $endDate)->where('telat', 1)->count();
            array_push($dataRekapAbsen, (object) [
                'no_identitas' => $peg->no_identitas,
                'nama' => $peg->nama,
                'hariKerja' => $hariKerja,
                'kehadiran' => $kehadiran,
                'tanpaKet' => $tanpaKet,
                'izin' => $izin,
                'telat' => $telat,
            ]);
        }
        return view('pages.rekap.index', compact('dataRekapAbsen', 'tgl', 'firstDate', 'endDate'));
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
