<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Setup');
        $request->session()->put('child', 'Lokasi');
        return view('pages.lokasi.index');
    }

    public function getServerSide()
    {
        $jenis_kwitansi = Lokasi::all();
        return Datatables::of($jenis_kwitansi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="showModalsEdit(' . $row->id . ',\'' . $row->lokasi . '\')" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
            
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
        $cek = Lokasi::where('lokasi', $request->lokasi)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Lokasi');
            return Redirect::to('/lokasi')->withErrors(['Lokasi tersebut telah digunakan.'])->withInput();
        } else {
            Lokasi::create([
                "lokasi" =>  $request->lokasi,
                "user" => Auth::user()->nama,
            ]);
            Alert::success('Success!', 'Data Lokasi Added!');
            return Redirect::to('/lokasi');
        }
    }


    public function edits(Request $request)
    {
        // return $request;
        $cek = Lokasi::where('lokasi', $request->lokasi)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Lokasi');
            return Redirect::to('/lokasi')->withErrors(['Lokasi tersebut telah digunakan.'])->withInput();
        } else {
            Lokasi::where('id', $request->id_lokasi)
                ->update([
                    "lokasi" =>  $request->lokasi,
                    "user" => Auth::user()->nama,
                ]);
            Alert::success('Success!', 'Data Lokasi Updated!');
            return Redirect::to('/lokasi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        //
    }
}
