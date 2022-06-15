<?php

namespace App\Http\Controllers;

use App\JenisIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class JenisIzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Absen');
        $request->session()->put('child', 'Jenis Izin');
        return view('pages.jenis_izin.index');
    }

    public function getServerSide()
    {
        $users = JenisIzin::all();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                //     $btn = '<div class="btn-group btn-group-sm" role="group">
                //     <a href="/jenis-izin/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                //     <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
                // </div>';
                $btn = '<div class="btn-group btn-group-sm" role="group">
            <a href="/jenis-izin/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
           
        </div>';
                return $btn;
            })->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('pages.jenis_izin.create', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $cek = JenisIzin::where('jenis', $request->jenis)->get();
            if (count($cek) > 0) {
                Alert::warning('Warning!', 'Duplicate Pegawai');
                return Redirect::to('/jenis-izin/create')->withErrors(['Jenis Izin tersebut telah digunakan.'])->withInput();
            } else {
                JenisIzin::create([
                    'jenis' => $request->jenis,
                    'status' => $request->status,
                ]);
            }
            alert()->success('Berhasil Tambah Jenis Izin!');
            return Redirect::to('/jenis-izin');
        } catch (\Throwable $th) {
            alert()->error('Oppss !!', $th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisIzin  $jenisIzin
     * @return \Illuminate\Http\Response
     */
    public function show(JenisIzin $jenisIzin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisIzin  $jenisIzin
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisIzin $jenisIzin)
    {
        $action = 'edit';
        return view('pages.jenis_izin.create', compact('action', 'jenisIzin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisIzin  $jenisIzin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisIzin $jenisIzin)
    {
        try {
            if ($request->jenis != $jenisIzin->nama) {
                $cek = Pegawai::where('nama', $request->jenis)->get();
                if (count($cek) > 0) {
                    Alert::warning('Warning!', 'Duplicate Pegawai');
                    return Redirect::to('/jenis-izin/create')->withErrors(['Jenis Izin tersebut telah digunakan.'])->withInput();
                } else {
                    $jenisIzin->jenis = $request->jenis;
                    $jenisIzin->status = $request->status;
                    $jenisIzin->save();
                }
            } else {
                $jenisIzin->status = $request->status;
                $jenisIzin->save();
            }

            alert()->success('Berhasil Update Pegawai!');
            return Redirect::to('/pegawai');
        } catch (\Throwable $th) {
            alert()->error('Oppss !!', $th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisIzin  $jenisIzin
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisIzin $jenisIzin)
    {
        $jenisIzin->delete();
    }
}
