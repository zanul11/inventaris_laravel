<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangKeluar;
use App\BarangMasuk;
use App\Bidang;
use App\DetailBarangKeluar;
use App\Jenis;
use App\Pegawai;
use App\Satuan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Yajra\DataTables\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Manajemen Barang');
        $request->session()->put('child', 'Data Barang');
        $request->session()->put('barang', 'Exist');
        // $user = User::with('jabatans')->paginate(10);
        // return Barang::with('jenis')->get();

        return view('pages.barang.index');
    }

    public function barangDeleted(Request $request)
    {
        $request->session()->put('barang', 'Deleted');
        return view('pages.barang.index');
    }
    public function barangAll(Request $request)
    {
        $request->session()->put('barang', 'All');
        return view('pages.barang.index');
    }

    public function getServerSide()
    {

        $barang = Barang::with('jenis_detail')->with('satuan_detail')->get();

        return Datatables::of($barang)
            ->addIndexColumn()
            ->addColumn('nama_barang', function ($row) {
                return $row->nama . '/' . $row->merk;
            })
            ->addColumn('action', function ($row) {
                //     $btn = '<div class="btn-group btn-group-sm" role="group">
                //     <a href="/barang/' . $row->kode . '" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                //     <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>

                // </div>';
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
                <button id="" class="btn btn-white dropdown-toggle" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                    <a href="/barang/' . $row->kode . '" class="dropdown-item"> Edit</a>
                    <a href="/barang/' . $row->kode . '/edit" class="dropdown-item"> Kartu Barang</a>
                </div>
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
        $action = 'add';

        $barang = User::first();
        $jenis = Jenis::all();
        $satuan = Satuan::all();
        $maxno = Barang::max('no');

        $generateNomor = 'LGSTK.BRG-';
        if ($maxno < 10)
            $kode = $generateNomor . '00' . ($maxno + 1);
        else if ($maxno < 99)
            $kode = $generateNomor . '0' . ($maxno + 1);
        else
            $kode = $generateNomor . ($maxno + 1);

        return view('pages.barang.create', compact('action',  'barang', 'kode', 'jenis', 'satuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //generate number,kode
        $maxno = Barang::max('no');
        $generateNomor = 'LGSTK.BRG-';
        if ($maxno < 10)
            $kode = $generateNomor . '00' . ($maxno + 1);
        else if ($maxno < 99)
            $kode = $generateNomor . '0' . ($maxno + 1);
        else
            $kode = $generateNomor . ($maxno + 1);

        $harga = preg_replace('/[^0-9]/', '', $request->harga);
        // return $request;
        $cekBarang = Barang::where('nama', $request->nama)->where('ukuran', $request->ukuran)->get();

        if (count($cekBarang) > 0) {
            Alert::warning('Warning!', 'Nama & type barang tersebut telah digunakan');
            return Redirect::to('/barang/create')->withErrors(['Nama & type barang tersebut telah digunakan.'])->withInput();
        } else {
            Barang::create([
                "no" => ($maxno + 1),
                "kode" => $kode,
                "jenis" => $request->jenis,
                "harga" => $harga,
                "nama" => $request->nama,
                "merk" => $request->merk,
                "stok" => $request->stok,
                "minimum" => $request->minimum,
                "ukuran" => $request->ukuran,
                "satuan" => $request->satuan,
                "user" => Auth::user()->nama
            ]);
            Alert::success('Success!', 'Data Barang Added!');
            return Redirect::to('/barang');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        $action = '/barang/' . $barang->id;
        // $pegawais = Pegawai::all();
        $jenis = Jenis::all();
        $satuan = Satuan::all();
        $log_masuk = BarangMasuk::where('barang_id', $barang->id)->sum('jumlah');
        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $barang->id)->sum('jumlah');
        $saldo_awal = $barang->stok - ($log_masuk - $log_keluar);
        return view('pages.barang.create', compact('action', 'barang', 'jenis', 'satuan', 'saldo_awal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $myArray = [];
        $barang =  Barang::where('id', $barang->id)->with('kartu_barang')->with('kartu_barang')->first();
        foreach ($barang->kartu_barang as $dt) {
            array_push($myArray, (object) [
                'tgl' => $dt['created_at'],
                'jenis' => 1,
                'diterima' => $dt['jumlah'],
                'dikeluarkan' => 0,
                'sisa' => $dt['stok'],
                'kode' => $dt['kode']
            ]);
        }
        // return BarangKeluar::with('bidang')->where('kode', '001/RT/III/2021')->first();
        $keluar = DetailBarangKeluar::with('barang')->where('barang_id', $barang->id)->get();
        foreach ($keluar as $dt) {
            $detail = BarangKeluar::where('kode', $dt['log_kode'])->first();
            array_push($myArray, (object) [
                'tgl' => $dt['created_at'],
                'jenis' => 0,
                'diterima' => $detail['pj'],
                'dikeluarkan' => $dt['jumlah'],
                'sisa' => $dt['sisa'],
                'kode' => $dt['log_kode']
            ]);
        }

        $kartu_barang = collect($myArray)->sortBy('tgl')->values()->all();
        return view('cetak.kartu_barang', compact('barang', 'kartu_barang'));
    }

    public function getBarang()
    {
        $barang = Barang::with('satuan_detail')->get();
        return $barang;
    }
    public function getPegawai()
    {
        $peg = Pegawai::all();
        return $peg;
    }
    public function getBidang()
    {
        $peg = Bidang::all();
        return $peg;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $harga = preg_replace('/[^0-9]/', '', $request->harga);
        // return $request;
        $log_masuk = BarangMasuk::where('barang_id', $barang->id)->sum('jumlah');
        $log_keluar = DetailBarangKeluar::with('detail')->where('barang_id', $barang->id)->sum('jumlah');
        $saldo_awal = $barang->stok - ($log_masuk - $log_keluar);

        if ($barang->nama == $request->nama && $barang->ukuran == $request->ukuran) {
            // if ($request->stok + ($log_masuk - $log_keluar) < 0) {
            //     Alert::warning('Warning!', 'Saldo Awal Kurang dari Saldo sebelumnya!');
            //     return Redirect::to('/barang/' . $barang->kode)->withInput();
            // }
            // $barang->stok = $request->stok + ($log_masuk - $log_keluar);
            $barang->jenis = $request->jenis;
            $barang->merk = $request->merk;
            $barang->satuan = $request->satuan;
            $barang->harga = $harga;
            $barang->minimum = $request->minimum;
            $barang->ukuran = $request->ukuran;
            $barang->save();
        } else {
            if ($request->stok + ($log_masuk - $log_keluar) < 0) {
                Alert::warning('Warning!', 'Saldo Awal Kurang dari Saldo sebelumnya!');
                return Redirect::to('/barang/' . $barang->kode)->withInput();
            } else {
                $cekBarang = Barang::where('nama', $request->nama)->where('ukuran', $request->ukuran)->where('id', '!=', $barang->id)->get();
                if (count($cekBarang) > 0) {
                    Alert::warning('Warning!', 'Nama & type barang tersebut telah digunakan');
                    return Redirect::to('/barang/' . $barang->kode)->withErrors(['Nama & type barang tersebut telah digunakan.'])->withInput();
                } else {
                    $barang->stok = $request->stok + ($log_masuk - $log_keluar);
                    $barang->jenis = $request->jenis;
                    $barang->merk = $request->merk;
                    $barang->nama = $request->nama;
                    $barang->satuan = $request->satuan;
                    $barang->harga = $harga;
                    $barang->minimum = $request->minimum;
                    $barang->ukuran = $request->ukuran;
                    $barang->save();
                }
            }
        }
        Alert::success('Success!', 'Data Barang Updated!');
        return Redirect::to('/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($barang)
    {
        // return $barang;
        // $user->delete();
        if (BarangMasuk::where('barang_id', $barang)->first()) {
            return 1;
        } else if (DetailBarangKeluar::where('barang_id', $barang)->first()) {
            return 2;
        } else {
            DB::table('barang')
                ->where('id', $barang)
                ->delete();
            return 3;
        }
    }

    public function delete(Barang $barang)
    {
        return $barang;
        // $user->delete();
        if (BarangMasuk::where('barang_id', $barang->id)->first()) {
            return 1;
        } else if (DetailBarangKeluar::where('barang_id', $barang->id)->first()) {
            return 2;
        } else {
            // DB::table('barang')
            //     ->where('id', $barang->id)
            //     ->delete();
            return 3;
        }
    }
}
