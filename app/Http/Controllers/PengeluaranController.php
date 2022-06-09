<?php

namespace App\Http\Controllers;

use App\JenisAkunting;
use App\LogKoreksi;
use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Keuangan');
        $request->session()->put('child', 'Pengeluaran');
        return view('pages.pengeluaran.index');
    }

    public function getServerSide()
    {
        $data = Pengeluaran::with('jenis_akunting')->where('jenis', 0)->orderby('updated_at', 'desc')->orderby('status', 'desc')->orderby('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uang', function ($row) {
                return number_format($row->jumlah);
            })
            ->addColumn('action', function ($row) {
                if (Auth::user()->type == 2) {
                    if ($row->status == 0) {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    } else if ($row->status == 2) {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                    <a href="/pengeluaran/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    } else {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                        <a href="/pengeluaran/' . $row->id . '" class="btn btn-warning" style="font-size:12px; color:white;">Lihat</a>
                       ';
                    }
                } else if (Auth::user()->type == 3) {
                    if ($row->status == 0) {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                    <a href="/pengeluaran/' . $row->id . '/konfirmasi" class="btn btn-warning" style="font-size:12px; color:white;">Konfirmasi</a>
                    <a href="/pengeluaran/' . $row->id . '" class="btn btn-success" style="font-size:12px; color:white;">Lihat</a>';
                    } else {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                        <a href="/pengeluaran/' . $row->id . '" class="btn btn-success" style="font-size:12px; color:white;">Lihat</a>';
                    }
                } else {
                    if ($row->status == 0 || $row->status == 2) {
                        $btn = '<div class="btn-group btn-group-sm" role="group"> 
                    <a href="/pengeluaran/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                    <a href="/pengeluaran/' . $row->id . '/konfirmasi" class="btn btn-primary" style="font-size:12px; color:white;">Konfirmasi</a>
                    <a href="/pengeluaran/' . $row->id . '" class="btn btn-success" style="font-size:12px; color:white;">Lihat</a>
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    } else  if ($row->status == 0 || $row->status == 2) {
                        $btn = '<div class="btn-group btn-group-sm" role="group"> 
                    <a href="/pengeluaran/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                   
                    <a href="/pengeluaran/' . $row->id . '" class="btn btn-success" style="font-size:12px; color:white;">Lihat</a>
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    } else {
                        $btn = '<div class="btn-group btn-group-sm" role="group"> 
                    
                        <a href="/pengeluaran/' . $row->id . '" class="btn btn-success" style="font-size:12px; color:white;">Lihat</a>
                        <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    }
                }


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
        return view('pages.pengeluaran.create', compact('action', 'jenis'));
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
            $foto = null;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = public_path() . '/uploads/';
                $foto = 'foto_pengeluaran_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $foto);
            }
            Pengeluaran::create([
                'jenis_akunting_id' => $request->jenis_akunting_id,
                'nama' => $request->nama,
                'jenis' => 0,
                'jumlah' => $request->jumlah,
                'ket' => $request->ket,
                'file' => $foto,
                'status' => 0,
                'tgl' => date('Y-m-d'),
                'user' => Auth::user()->nama,
            ]);

            alert()->success('Berhasil Tambah Pengeluaran !');
            return Redirect::to('/pengeluaran');
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
    public function show(Pengeluaran $pengeluaran)
    {
        $action = 'lihat';
        $jenis = JenisAkunting::orderby('jenis')->get();
        return view('pages.pengeluaran.konfirmasi', compact('action', 'jenis', 'pengeluaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        $action = 'edit';
        $jenis = JenisAkunting::orderby('jenis')->get();
        return view('pages.pengeluaran.create', compact('action', 'jenis', 'pengeluaran'));
    }

    public function konfirmasi(Pengeluaran $pengeluaran)
    {
        // return $pengeluaran->log;
        $action = 'konfirmasi';
        $jenis = JenisAkunting::orderby('jenis')->get();
        return view('pages.pengeluaran.konfirmasi', compact('action', 'jenis', 'pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        // return $request;
        try {
            if ($request->action == 'konfirmasi') {
                Pengeluaran::where('id', $pengeluaran->id)
                    ->update([
                        'status' => $request->status,
                    ]);
                LogKoreksi::create([
                    'keuangan_id' => $pengeluaran->id,
                    'ket' => $request->ket_konfirmasi,
                    'user' => Auth::user()->nama,
                ]);
                alert()->success('Berhasil Koreksi Pengeluaran !');
            } else {
                $path = public_path() . '/uploads/';
                $foto = $pengeluaran->file;
                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $foto = 'foto_pengeluaran_' . time() . '.' . $image->getClientOriginalExtension();
                    if (file_exists($path . $pengeluaran->foto) && $pengeluaran->foto != null)
                        unlink($path . $pengeluaran->foto);
                    $image->move($path, $foto);
                }
                Pengeluaran::where('id', $pengeluaran->id)
                    ->update([
                        'jenis_akunting_id' => $request->jenis_akunting_id,
                        'nama' => $request->nama,
                        'jumlah' => $request->jumlah,
                        'ket' => $request->ket,
                        'file' => $foto,
                        'status' => 0,
                        'user' => Auth::user()->nama,
                    ]);

                alert()->success('Berhasil Update Pengeluaran !');
            }

            return Redirect::to('/pengeluaran');
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
    public function destroy(Pengeluaran $pengeluaran)
    {
        $path = public_path() . '/uploads/';
        if (file_exists($path . $pengeluaran->file) && $pengeluaran->file != null)
            unlink($path . $pengeluaran->file);
        $pengeluaran->delete();
    }
}
