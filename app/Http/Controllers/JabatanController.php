<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Setup');
        $request->session()->put('child', 'Jabatan');
        return view('pages.jabatan.index');
    }

    public function getServerSide()
    {
        $jenis_kwitansi = Jabatan::all();
        return Datatables::of($jenis_kwitansi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="showModalsEdit(' . $row->id . ',\'' . $row->jabatan . '\')" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
            
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
        $cek = Jabatan::where('jabatan', $request->jabatan)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Jabatan');
            return Redirect::to('/jabatan')->withErrors(['Jabatan tersebut telah digunakan.'])->withInput();
        } else {
            Jabatan::create([
                "jabatan" =>  $request->jabatan,
                "user" => Auth::user()->nama,
            ]);
            Alert::success('Success!', 'Data Jabatan Added!');
            return Redirect::to('/jabatan');
        }
    }

    public function edits(Request $request)
    {
        // return $request;
        $cek = Jabatan::where('jabatan', $request->lokasi)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Jabatan');
            return Redirect::to('/jabatan')->withErrors(['Jabatan tersebut telah digunakan.'])->withInput();
        } else {
            Jabatan::where('id', $request->id_jabatan)
                ->update([
                    "jabatan" =>  $request->jabatan,
                    "user" => Auth::user()->nama,
                ]);
            Alert::success('Success!', 'Data Jabatan Updated!');
            return Redirect::to('/jabatan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }
}
