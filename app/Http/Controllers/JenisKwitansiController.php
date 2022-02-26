<?php

namespace App\Http\Controllers;

use App\JenisKwitansi;
use App\Kwitansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class JenisKwitansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Setup');
        $request->session()->put('child', 'Jenis Kwitansi');
        return view('pages.jenis-kwitansi.index');
    }


    public function getServerSide()
    {
        $jenis_kwitansi = JenisKwitansi::all();
        return Datatables::of($jenis_kwitansi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="showModalsEdit(' . $row->id . ',\'' . $row->jenis . '\')" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
            
            </div>';
                return $btn;
            })
            ->make();
    }


    public function getJenis()
    {
        return JenisKwitansi::orderby('jenis')->get();
    }

    public function getJumlahJenis(Request $request)
    {
        return Kwitansi::where('jenis', $request->jenis)->where('status', 0)->sum('jumlah');
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
        $cek = JenisKwitansi::where('jenis', $request->jenis)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Jenis');
            return Redirect::to('/jenis-kwitansi')->withErrors(['Jenis tersebut telah digunakan.'])->withInput();
        } else {
            JenisKwitansi::create([
                "jenis" =>  $request->jenis,
                "user" => Auth::user()->nama,
            ]);
            Alert::success('Success!', 'Data Jenis Added!');
            return Redirect::to('/jenis-kwitansi');
        }
    }


    public function edits(Request $request)
    {
        // return $request;
        $cek = JenisKwitansi::where('jenis', $request->jenis)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Jenis');
            return Redirect::to('/jenis-kwitansi')->withErrors(['Jenis tersebut telah digunakan.'])->withInput();
        } else {
            JenisKwitansi::where('id', $request->id_jenis)
                ->update([
                    "jenis" =>  $request->jenis,
                    "user" => Auth::user()->nama,
                ]);
            Alert::success('Success!', 'Data Jenis Updated!');
            return Redirect::to('/jenis-kwitansi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisKwitansi  $jenisKwitansi
     * @return \Illuminate\Http\Response
     */
    public function show(JenisKwitansi $jenisKwitansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisKwitansi  $jenisKwitansi
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisKwitansi $jenisKwitansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisKwitansi  $jenisKwitansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisKwitansi $jenisKwitansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisKwitansi  $jenisKwitansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisKwitansi $jenisKwitansi)
    {
        //
    }
}
