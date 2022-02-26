<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class JenisController extends Controller
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


    public function getServerSide()
    {
        $jenis = Jenis::all();
        return Datatables::of($jenis)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="showModalsEditJenis(' . $row->id . ',\'' . $row->jenis . '\')" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
            
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
        // return $request;
        $cekJenis = Jenis::where('jenis', $request->jenis)->get();
        if (count($cekJenis) > 0) {
            Alert::warning('Warning!', 'Duplicate Jenis');
            return Redirect::to('/satuan')->withErrors(['Jenis tersebut telah digunakan.'])->withInput();
        } else {
            Jenis::create([
                "jenis" =>  $request->jenis,
                "user" => Auth::user()->nama,
            ]);
            Alert::success('Success!', 'Data Jenis Added!');
            return Redirect::to('/satuan');
        }
    }

    public function edits(Request $request)
    {
        // return $request;
        $cekJenis = Jenis::where('jenis', $request->jenis)->get();
        if (count($cekJenis) > 0) {
            Alert::warning('Warning!', 'Duplicate Jenis');
            return Redirect::to('/satuan')->withErrors(['Jenis tersebut telah digunakan.'])->withInput();
        } else {
            Jenis::where('id', $request->id_jenis)
                ->update([
                    "jenis" =>  $request->jenis,
                    "user" => Auth::user()->nama,
                ]);
            Alert::success('Success!', 'Data Jenis Updated!');
            return Redirect::to('/satuan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis $jenis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis $jenis)
    {
        //
    }
}
