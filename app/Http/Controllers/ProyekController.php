<?php

namespace App\Http\Controllers;

use App\BarangMasuk;
use App\DetailBarangKeluar;
use App\DetailPinjam;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Proyek');
        $request->session()->put('child', 'Data Proyek');
        return view('pages.proyek.index');
    }



    public function getServerSide()
    {

        $peg = Proyek::orderby('nama')->get();

        return DataTables::of($peg)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a href="/proyek/' . $row->id . '" class="btn btn-primary" style="font-size:12px; color:white;">Kelengkapan</a>
                <a href="/proyek/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
            </div>';
                return $btn;
            })
            ->make();
    }

    public function getData()
    {
        return Proyek::whereYear('created_at', date('Y'))->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';

        return view('pages.proyek.create', compact('action'));
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
        $cek = Proyek::where('nama', $request->nama)->get();

        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Proyek tersebut telah digunakan');
            return Redirect::to('/proyek/create')->withErrors(['Proyek tersebut telah digunakan.'])->withInput();
        } else {
            $file = null;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = public_path() . '/uploads/';
                $file = 'file_proyek_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $file);
            }
            Proyek::create([
                "nama" => $request->nama,
                "pj" => $request->pj,
                "lokasi" => $request->lokasi,
                "ket" => $request->ket,
                "file" => $file,
            ]);
            Alert::success('Success!', 'Data Proyek Added!');
            return Redirect::to('/proyek');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function show(Proyek $proyek)
    {
        $barang = DetailBarangKeluar::with('barang.satuan_detail')->where('proyek_id', $proyek->id)->get();
        $alat = DetailPinjam::with('alat.satuan_detail')->where('proyek_id', $proyek->id)->get();
        return view('pages.proyek.kelengkapan', compact('proyek', 'barang', 'alat'));
    }
    public function cetakKelangkapan(Proyek $proyek)
    {

        $barang = DetailBarangKeluar::with('barang.satuan_detail')->where('proyek_id', $proyek->id)->get();
        $alat = DetailPinjam::with('alat.satuan_detail')->where('proyek_id', $proyek->id)->get();
        return view('pages.proyek.cetak', compact('proyek', 'barang', 'alat'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyek $proyek)
    {
        $action = 'edit';
        return view('pages.proyek.create', compact('action', 'proyek'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyek $proyek)
    {
        $path = public_path() . '/uploads/';
        $file = $proyek->file;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $file = 'file_proyek_' . time() . '.' . $image->getClientOriginalExtension();
            if (file_exists($path . $proyek->file) && $proyek->file != null)
                unlink($path . $proyek->file);
            $image->move($path, $file);
        }
        if ($proyek->nama == $request->nama) {
            $proyek->pj = $request->pj;
            $proyek->lokasi = $request->lokasi;
            $proyek->ket = $request->ket;
            $proyek->file = $file;
            $proyek->save();
        } else {

            $cek = Proyek::where('nama', $request->nama)->get();
            if (count($cek) > 0) {
                Alert::warning('Warning!', 'Proyek tersebut telah digunakan');
                return Redirect::to('/proyek/create')->withErrors(['Proyek tersebut telah digunakan.'])->withInput();
            } else {
                $proyek->nama = $request->nama;
                $proyek->pj = $request->pj;
                $proyek->lokasi = $request->lokasi;
                $proyek->ket = $request->ket;
                $proyek->file = $file;
                $proyek->save();
            }
        }
        Alert::success('Success!', 'Data Proyek Updated!');
        return Redirect::to('/proyek');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyek $proyek)
    {
        if (BarangMasuk::where('proyek_id', $proyek->id)->first()) {
            return 1;
        } else if (DetailPinjam::where('proyek_id', $proyek->id)->first()) {
            return 2;
        } else {
            $path = public_path() . '/uploads/';
            if (file_exists($path . $proyek->file) && $proyek->file != null)
                unlink($path . $proyek->file);
            $proyek->delete();
            return 3;
        }
    }
}
