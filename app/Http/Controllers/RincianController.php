<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class RincianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Laporan Absen');
        $request->session()->put('child', 'Rincian Absen');

        $firstDate = date('Y-m-') . '1';
        $endDate = date('Y-m-d');
        $tgl  = '01' . date('-m-Y') . ' s/d ' . date('d-m-Y');

        $pegawai = Pegawai::with(['absen' => function ($query) use ($firstDate, $endDate) {
            $query->whereDate('tgl', '>=', $firstDate);
            $query->whereDate('tgl', '<=', $endDate);
        }])->get();
        return view('pages.rincian.index', compact('pegawai', 'tgl', 'firstDate', 'endDate'));
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

        $pegawai = Pegawai::with(['absen' => function ($query) use ($firstDate, $endDate) {
            $query->whereDate('tgl', '>=', $firstDate);
            $query->whereDate('tgl', '<=', $endDate);
        }])->get();
        return view('pages.rincian.index', compact('pegawai', 'tgl', 'firstDate', 'endDate'));
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
