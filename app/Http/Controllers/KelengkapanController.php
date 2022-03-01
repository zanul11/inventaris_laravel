<?php

namespace App\Http\Controllers;

use App\Kelengkapan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class KelengkapanController extends Controller
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
        // return $request;
        try {
            Kelengkapan::create([
                'id_logistik' => $request->id_logistik,
                'spesifikasi' => $request->spesifikasi,
                'merk' => $request->merk,
                'stok' => $request->stok,
                'rusak' => $request->rusak,
                'id_lokasi' => $request->lokasi,
                'id_satuan' => $request->satuan,
            ]);
        } catch (\Throwable $th) {
            Alert::warning('Oppps!', $th->getMessage());
            return Redirect::to('/logistik/' . $request->id_logistik)->withErrors([$th->getMessage()])->withInput();
        }
        Alert::success('Success!', 'Data Kelengkapan Logistik Added!');
        return Redirect::to('/logistik/' . $request->id_logistik);
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
        Kelengkapan::where('id', $id)->delete();
    }
}
