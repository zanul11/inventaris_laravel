<?php

namespace App\Http\Controllers;

use App\Kas;
use App\KasTmp;
use Illuminate\Http\Request;

class KasTmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        KasTmp::create([
            "kode" => $request->kode
        ]);
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //hapus semua
        KasTmp::truncate();
        return 'hapus semua';
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

    public function getKwitansiAll()
    {
        return KasTmp::with('kwitansi', 'kwitansi.kwitansis')->orderBy('created_at', 'desc')->get();
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
        //pilih semua kwitansi
        foreach ($request->kwitansi as $dt) {
            KasTmp::create([
                "kode" => $dt['kode']
            ]);
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
    }

    public function delete(Request $request)
    {
        KasTmp::where('kode', $request->kode)->delete();
        return $request;
    }
}
