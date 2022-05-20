<?php

namespace App\Http\Controllers;

use App\Libur;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class LiburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Absen');
        $request->session()->put('child', 'Tanggal Libur');
        return view('pages.libur.index');
    }

    public function getServerSide()
    {
        $users = Libur::whereYear('tgl_mulai', date('Y'))->whereYear('tgl_akhir', date('Y'))->get();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
              
                <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
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
        return view('pages.libur.create', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rep_date = str_replace(" ", "", $request->tgl_libur);
        $exp_date = explode("s/d", $rep_date);
        try {
            Libur::create([
                'tgl_mulai' => date('Y-m-d', strtotime($exp_date[0])),
                'tgl_akhir' => date('Y-m-d', strtotime($exp_date[1])),
                'ket' => $request->ket ?? '-',
            ]);

            alert()->success('Berhasil Tambah Hari Libur!');
            return Redirect::to('/libur');
        } catch (\Throwable $th) {
            alert()->error('Oppss !!', $th->getMessage());
            return back()->withInput();
        }
        return $exp_date;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libur  $libur
     * @return \Illuminate\Http\Response
     */
    public function show(Libur $libur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libur  $libur
     * @return \Illuminate\Http\Response
     */
    public function edit(Libur $libur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libur  $libur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libur $libur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libur  $libur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libur $libur)
    {
        $libur->delete();
    }
}
