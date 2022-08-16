<?php

namespace App\Http\Controllers;

use App\JenisAkunting;
use App\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Keuangan');
        $request->session()->put('child', 'Pemasukan');
        return view('pages.pemasukan.index');
    }

    public function getServerSide()
    {
        $data = Pemasukan::with('jenis_akunting')->where('jenis', 1)->orderby('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uang', function ($row) {
                return number_format($row->jumlah);
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a href="/pemasukan/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
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
        $jenis = JenisAkunting::orderby('jenis')->get();
        return view('pages.pemasukan.create', compact('action', 'jenis'));
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
            Pemasukan::create([
                'jenis_akunting_id' => $request->jenis_akunting_id,
                'nama' => $request->nama,
                'jenis' => 1,
                'jumlah' => $request->jumlah,
                'ket' => $request->ket,
                'status' => 4,
                'tgl' => date('Y-m-d'),
                'user' => Auth::user()->nama,
            ]);

            alert()->success('Berhasil Tambah Pemasukan !');
            return Redirect::to('/pemasukan');
        } catch (\Throwable $th) {
            alert()->error('Oppss !!', $th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukan $pemasukan)
    {
        $action = 'edit';
        $jenis = JenisAkunting::orderby('jenis')->get();
        return view('pages.pemasukan.create', compact('action', 'jenis', 'pemasukan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        try {
            Pemasukan::where('id', $pemasukan->id)
                ->update([
                    'jenis_akunting_id' => $request->jenis_akunting_id,
                    'nama' => $request->nama,
                    'jumlah' => $request->jumlah,
                    'ket' => $request->ket,
                    'user' => Auth::user()->nama,
                ]);

            alert()->success('Berhasil Update Pemasukan !');
            return Redirect::to('/pemasukan');
        } catch (\Throwable $th) {
            alert()->error('Oppss !!', $th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();
    }
}
