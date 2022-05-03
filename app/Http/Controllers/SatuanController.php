<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Setup');
        $request->session()->put('child', 'Satuan & Jenis');
        // $user = User::with('jabatans')->paginate(10);
        return view('pages.satuan.index');
    }

    public function getServerSide()
    {
        $satuan = Satuan::all();
        return Datatables::of($satuan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="showModalsEdit(' . $row->id . ',\'' . $row->satuan . '\')" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
            
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
        $cekSatuan = Satuan::where('satuan', $request->satuan)->get();
        if (count($cekSatuan) > 0) {
            Alert::warning('Warning!', 'Duplicate Satuan');
            return Redirect::to('/satuan')->withErrors(['Satuan tersebut telah digunakan.'])->withInput();
        } else {
            Satuan::create([
                "satuan" =>  $request->satuan,
                "user" => Auth::user()->nama,
            ]);
            Alert::success('Success!', 'Data Satuan Added!');
            return Redirect::to('/satuan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        //
    }

    public function edits(Request $request)
    {
        // return $request;
        $cekSatuan = Satuan::where('satuan', $request->satuan)->get();
        if (count($cekSatuan) > 0) {
            Alert::warning('Warning!', 'Duplicate Satuan');
            return Redirect::to('/satuan')->withErrors(['Satuan tersebut telah digunakan.'])->withInput();
        } else {
            Satuan::where('id', $request->id_satuan)
                ->update([
                    "satuan" =>  $request->satuan,
                    "user" => Auth::user()->nama,
                ]);
            Alert::success('Success!', 'Data Satuan Updated!');
            return Redirect::to('/satuan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        //
    }
}
