<?php

namespace App\Http\Controllers;

use App\DetailPinjam;
use App\Jenis;
use App\LogPeralatanMasuk;
use App\Lokasi;
use App\Peralatan;
use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PeralatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Manajemen Peralatan');
        $request->session()->put('child', 'Data Peralatan');
        return view('pages.peralatan.index');
    }

    public function getServerSide()
    {

        $barang = Peralatan::with(['jenis_detail', 'satuan_detail', 'lokasi'])->get();

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                // </div>';

                $delete = "";

                $delete = "<a href='#' onclick='btnDelete(" . $row->id . ")' class='f-s-16 text-danger' title='Hapus Data'>
                <i class='fa fa-minus-square'></i></a>";

                $edit = "<a href='/peralatan/" . $row->id . "/edit' class='f-s-16 text-warning' title='Edit Data'><i class='fa fa-pen-square'></i></a>";

                $keahlian = "<a href='#' onclick='btnTambahPeralatan(" . $row->id . ")' class='f-s-16 text-success' title='Peralatan Masuk'>
                <i class='fa fa-plus-square'></i></a>";

                $rusak = "<a href='#' onclick='btnRusakPeralatan(" . $row->id . ")' class='f-s-16 text-primary' title='Peralatan Rusak'>
                <i class='fa fa-arrow-circle-up'></i></a>";

                return $keahlian . '  ' . $rusak . '  ' . $edit . '  ' . $delete;
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
        $jenis = Jenis::all();
        $satuan = Satuan::all();
        $lokasi = Lokasi::all();
        $maxno = Peralatan::max('no');

        $generateNomor = 'LGSTK.PRLT-';
        if ($maxno < 10)
            $kode = $generateNomor . '00' . ($maxno + 1);
        else if ($maxno < 99)
            $kode = $generateNomor . '0' . ($maxno + 1);
        else
            $kode = $generateNomor . ($maxno + 1);

        return view('pages.peralatan.create', compact('action',  'kode', 'jenis', 'satuan', 'lokasi'));
    }


    public function tambahPeralatan(Request $request)
    {
        // return $request;
        if (!isset($request->stok)) {
            Alert::warning('Warning!', 'Stok Kosong!');
            return Redirect::to('/peralatan');
        }
        try {
            $peralatan = Peralatan::where('id', $request->id_edit)->first();
            Peralatan::where('id', $request->id_edit)
                ->update([
                    "stok" =>  $peralatan->stok + $request->stok,
                    "stok_aktif" =>  $peralatan->stok_aktif + $request->stok,
                ]);
            LogPeralatanMasuk::create([
                "peralatan_id" => $request->id_edit,
                "jumlah" => $request->stok,
                "pj" => $request->pegawai,
                "ket" => $request->ket,
                "tgl" => $request->tgl,
            ]);
        } catch (\Throwable $th) {
            alert()->error('Oppss !!', $th->getMessage())->persistent('Dismiss');
            return back()->withInput();
        }
        Alert::success('Success!', 'Data Peralatan Masuk Added!');
        return Redirect::to('/peralatan');

        // return $request;
    }


    public function rusakPeralatan(Request $request)
    {
        // return $request;
        if (!isset($request->stok)) {
            Alert::warning('Warning!', 'Stok Kosong!');
            return Redirect::to('/peralatan');
        }
        try {
            $peralatan = Peralatan::where('id', $request->id_edit)->first();
            Peralatan::where('id', $request->id_edit)
                ->update([
                    "rusak" =>  $peralatan->rusak + $request->stok,
                    "stok_aktif" =>  $peralatan->stok_aktif - $request->stok,
                ]);
            LogPeralatanMasuk::create([
                "peralatan_id" => $request->id_edit,
                "jumlah" => $request->stok,
                "pj" => Auth::user()->nama,
                "ket" => $request->ket,
                "tgl" => $request->tgl,
                "jenis" => 0
            ]);
        } catch (\Throwable $th) {
            alert()->error('Oppss !!', $th->getMessage())->persistent('Dismiss');
            return back()->withInput();
        }
        Alert::success('Success!', 'Data Peralatan Rusak Added!');
        return Redirect::to('/peralatan');

        // return $request;
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
        $maxno = Peralatan::max('no');
        $generateNomor = 'LGSTK.PRLT-';
        if ($maxno < 10)
            $kode = $generateNomor . '00' . ($maxno + 1);
        else if ($maxno < 99)
            $kode = $generateNomor . '0' . ($maxno + 1);
        else
            $kode = $generateNomor . ($maxno + 1);

        $harga = preg_replace('/[^0-9]/', '', $request->harga);
        // return $request;
        $cekPeralatan = Peralatan::where('nama', $request->nama)->where('lokasi_id', $request->lokasi)->get();

        if (count($cekPeralatan) > 0) {
            Alert::warning('Warning!', 'Nama Peralatan tersebut telah digunakan');
            return Redirect::to('/peralatan/create')->withErrors(['Nama Peralatan tersebut telah digunakan.'])->withInput();
        } else {
            $foto = null;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = public_path() . '/uploads/';
                $foto = 'foto_peralatan_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $foto);
            }

            Peralatan::create([
                "no" => ($maxno + 1),
                "kode" => $kode,
                "jenis_id" => $request->jenis,
                "lokasi_id" => $request->lokasi,
                "harga" => $harga,
                "nama" => $request->nama,
                "merk" => $request->merk,
                "stok" => $request->stok,
                "stok_awal" => $request->stok,
                "stok_aktif" => $request->stok,
                "rusak" => $request->rusak,
                "spesifikasi" => $request->spesifikasi, //type
                "satuan" => $request->satuan,
                "user" => Auth::user()->nama,
                "foto" => $foto,
            ]);
            Alert::success('Success!', 'Data Peralatan Added!');
            return Redirect::to('/peralatan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function show(Peralatan $peralatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Peralatan $peralatan)
    {
        $action = 'edit';
        $jenis = Jenis::all();
        $satuan = Satuan::all();
        $lokasi = Lokasi::all();
        return view('pages.peralatan.create', compact('action',  'jenis', 'satuan', 'lokasi', 'peralatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peralatan $peralatan)
    {
        // return $request;
        $path = public_path() . '/uploads/';
        $foto = $peralatan->foto;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $foto = 'foto_peralatan_' . time() . '.' . $image->getClientOriginalExtension();
            if (file_exists($path . $peralatan->foto) && $peralatan->foto != null)
                unlink($path . $peralatan->foto);
            $image->move($path, $foto);
        }
        $harga = preg_replace('/[^0-9]/', '', $request->harga);

        if ($peralatan->nama == $request->nama && $peralatan->lokasi_id == $request->lokasi) {
            $peralatan->lokasi_id = $request->lokasi;
            $peralatan->jenis_id = $request->jenis;
            $peralatan->merk = $request->merk;
            $peralatan->satuan = $request->satuan;
            $peralatan->harga = $harga;
            $peralatan->foto = $foto;
            $peralatan->spesifikasi = $request->spesifikasi;
            $peralatan->save();
        } else {
            $cekPeralatan = Peralatan::where('nama', $request->nama)->where('lokasi_id', $request->lokasi)->get();
            if (count($cekPeralatan) > 0) {
                Alert::warning('Warning!', 'Nama Peralatan tersebut telah digunakan');
                return Redirect::to('/peralatan/create')->withErrors(['Nama Peralatan tersebut telah digunakan.'])->withInput();
            } else {
                $peralatan->lokasi_id = $request->lokasi;
                $peralatan->jenis_id = $request->jenis;
                $peralatan->merk = $request->merk;
                $peralatan->nama = $request->nama;
                $peralatan->satuan = $request->satuan;
                $peralatan->harga = $harga;
                $peralatan->foto = $foto;
                $peralatan->spesifikasi = $request->spesifikasi;
                $peralatan->save();
            }
        }
        Alert::success('Success!', 'Data Peralatan Updated!');
        return Redirect::to('/peralatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peralatan $peralatan)
    {
        if (DetailPinjam::where('peralatan_id', $peralatan->id)->first()) {
            return 1;
        } else {
            $path = public_path() . '/uploads/';
            if (file_exists($path . $peralatan->foto) && $peralatan->foto != null)
                unlink($path . $peralatan->foto);
            $peralatan->delete();
            LogPeralatanMasuk::where('peralatan_id', $peralatan->id)->delete();
            return 3;
        }
    }
}
