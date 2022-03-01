<?php

namespace App\Http\Controllers;

use App\Jenis;
use App\Kelengkapan;
use App\Logistik;
use App\Lokasi;
use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class LogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Manajemen Logistik');
        $request->session()->put('child', 'Data Logistik');
        return view('pages.logistik.index');
    }

    public function getServerSide()
    {

        $barang = Logistik::get();

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('is_kelengkapan', function ($row) {
                return ($row->is_kelengkapan == 1) ? 'ADA KELENGKAPAN' : 'TANPA KELENGKAPAN';
            })
            ->addColumn('action', function ($row) {
                // </div>';
                if ($row->is_kelengkapan == 0) {
                    $delete = "";

                    $delete = "<a href='#' onclick='btnDelete(" . $row->id . ")' class='f-s-16 text-danger' title='Hapus Data'>
                <i class='fa fa-minus-square'></i></a>";

                    $edit = "<a href='/logistik/" . $row->id . "/edit' class='f-s-16 text-warning' title='Edit Data'><i class='fa fa-pen-square'></i></a>";

                    $keahlian = "";



                    return $keahlian . '  ' . $edit . '  ' . $delete;
                } else {
                    $delete = "";

                    $delete = "<a href='#' onclick='btnDelete(" . $row->id . ")' class='f-s-16 text-danger' title='Hapus Data'>
                <i class='fa fa-minus-square'></i></a>";

                    $edit = "<a href='/logistik/" . $row->id . "/edit' class='f-s-16 text-warning' title='Edit Data'><i class='fa fa-pen-square'></i></a>";

                    $keahlian = "";

                    $keahlian = "<a href='/logistik/" . $row->id . "' class='f-s-16 text-primary' title='Tambah Keahlian'><i class='fa fa-plus-square'></i></a>";


                    return $keahlian . '  ' . $edit . '  ' . $delete;
                }
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
        $action = 'add';
        $satuan = Satuan::all();
        $maxno = Logistik::max('no');
        $lokasi = Lokasi::orderby('lokasi')->get();

        $generateNomor = 'INV.LGSTK-';
        if ($maxno < 10)
            $kode = $generateNomor . '00' . ($maxno + 1);
        else if ($maxno < 99)
            $kode = $generateNomor . '0' . ($maxno + 1);
        else
            $kode = $generateNomor . ($maxno + 1);

        return view('pages.logistik.create', compact('action', 'kode', 'satuan', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $maxno = Logistik::max('no');
        $generateNomor = 'INV.LGSTK-';
        if ($maxno < 10)
            $kode = $generateNomor . '00' . ($maxno + 1);
        else if ($maxno < 99)
            $kode = $generateNomor . '0' . ($maxno + 1);
        else
            $kode = $generateNomor . ($maxno + 1);

        $cek = Logistik::where('nama', $request->nama)->get();
        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Duplicate Nama');
            return Redirect::to('/logistik/create')->withErrors(['Logistik tersebut telah digunakan.'])->withInput();
        } else {
            try {
                $save_logistik = Logistik::create([
                    'no' => $maxno + 1,
                    'kode' => $kode,
                    'nama' => $request->nama,
                    "is_kelengkapan" => $request->kelengkapan,
                    "user" => Auth::user()->nama
                ]);
            } catch (\Throwable $th) {
                Alert::warning('Oppps!', $th->getMessage());
                return Redirect::to('/logistik/create')->withErrors([$th->getMessage()])->withInput();
            }
            if ($request->kelengkapan == 0) {
                try {
                    Kelengkapan::create([
                        'id_logistik' => $save_logistik['id'],
                        'spesifikasi' => $request->spesifikasi,
                        'merk' => $request->merk,
                        'stok' => $request->stok,
                        'rusak' => $request->rusak,
                        'id_lokasi' => $request->lokasi,
                        'id_satuan' => $request->satuan,
                    ]);
                } catch (\Throwable $th) {
                    Alert::warning('Oppps!', $th->getMessage());
                    return Redirect::to('/logistik/create')->withErrors([$th->getMessage()])->withInput();
                }
            }
        }
        Alert::success('Success!', 'Data Logistik Added!');
        return Redirect::to('/logistik');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function show(Logistik $logistik)
    {
        $action = 'edit';
        $satuan = Satuan::all();
        $lokasi = Lokasi::orderby('lokasi')->get();
        $kelengkapan = Kelengkapan::where('id_logistik', $logistik->id)->get();

        return view('pages.logistik.kelengkapan', compact('action', 'logistik', 'satuan', 'lokasi', 'kelengkapan'));
        return $logistik;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function edit(Logistik $logistik)
    {
        $action = 'edit';
        $satuan = Satuan::all();
        $lokasi = Lokasi::orderby('lokasi')->get();

        return view('pages.logistik.create', compact('action', 'logistik', 'satuan', 'lokasi'));
        return $logistik;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logistik $logistik)
    {
        // return $request;
        if ($request->nama == $logistik->nama) {
            $logistik->user = Auth::user()->nama;
            if ($request->kelengkapan_edit == 0) {
                Kelengkapan::where('id_logistik', $logistik->id)->delete();
                try {
                    Kelengkapan::create([
                        'id_logistik' => $logistik->id,
                        'spesifikasi' => $request->spesifikasi,
                        'merk' => $request->merk,
                        'stok' => $request->stok,
                        'rusak' => $request->rusak,
                        'id_lokasi' => $request->lokasi,
                        'id_satuan' => $request->satuan,
                    ]);
                } catch (\Throwable $th) {
                    Alert::warning('Oppps!', $th->getMessage());
                    return Redirect::to('/logistik/create')->withErrors([$th->getMessage()])->withInput();
                }
            }
            $logistik->save();
        } else {
            $cek = Logistik::where('nama', $request->nama)->get();
            if (count($cek) > 0) {
                Alert::warning('Warning!', 'Duplicate Nama');
                return Redirect::to('/logistik/create')->withErrors(['Logistik tersebut telah digunakan.'])->withInput();
            } else {
                $logistik->nama = $request->nama;
                $logistik->user = Auth::user()->nama;
                if ($request->kelengkapan_edit == 0) {
                    Kelengkapan::where('id_logistik', $logistik->id)->delete();
                    try {
                        Kelengkapan::create([
                            'id_logistik' => $logistik->id,
                            'spesifikasi' => $request->spesifikasi,
                            'merk' => $request->merk,
                            'stok' => $request->stok,
                            'rusak' => $request->rusak,
                            'id_lokasi' => $request->lokasi,
                            'id_satuan' => $request->satuan,
                        ]);
                    } catch (\Throwable $th) {
                        Alert::warning('Oppps!', $th->getMessage());
                        return Redirect::to('/logistik/create')->withErrors([$th->getMessage()])->withInput();
                    }
                }
                $logistik->save();
            }
        }
        Alert::success('Success!', 'Data Logistik Updated!');
        return Redirect::to('/logistik');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logistik $logistik)
    {
        Kelengkapan::where('id_logistik', $logistik->id)->delete();
        $logistik->delete();
    }
}
