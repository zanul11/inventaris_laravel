<?php

namespace App\Http\Controllers;

use App\JenisAkunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class JenisAkuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Setup');
        $request->session()->put('child', 'Jenis Akunting');
        return view('pages.jenis_akunting.index');
    }

    public function getServerSide()
    {
        $jenis = JenisAkunting::all();
        return Datatables::of($jenis)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="showModalsEdit(' . $row->id . ',\'' . $row->jenis . '\')" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
            
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
        $cek = JenisAkunting::where('jenis', $request->jenis)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Jenis Akunting');
            return Redirect::to('/jenis-akunting')->withErrors(['Jenis Akunting tersebut telah digunakan.'])->withInput();
        } else {
            JenisAkunting::create([
                "jenis" =>  $request->jenis,
                "user" => Auth::user()->nama,
            ]);
            Alert::success('Success!', 'Data Jenis Akunting Added!');
            return Redirect::to('/jenis-akunting');
        }
    }

    public function edits(Request $request)
    {
        $cek = JenisAkunting::where('jenis', $request->jenis)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Jenis Akunting');
            return Redirect::to('/jenis-akunting')->withErrors(['Jenis Akunting tersebut telah digunakan.'])->withInput();
        } else {
            JenisAkunting::where('id', $request->id_jenis)
                ->update([
                    "jenis" =>  $request->jenis,
                    "user" => Auth::user()->nama,
                ]);
            Alert::success('Success!', 'Data Jenis Akunting Updated!');
            return Redirect::to('/jenis-akunting');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\JenisAkunting  $jenisAkunting
     * @return \Illuminate\Http\Response
     */
    public function show(JenisAkunting $jenisAkunting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisAkunting  $jenisAkunting
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisAkunting $jenisAkunting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisAkunting  $jenisAkunting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisAkunting $jenisAkunting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisAkunting  $jenisAkunting
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisAkunting $jenisAkunting)
    {
        //
    }
}
