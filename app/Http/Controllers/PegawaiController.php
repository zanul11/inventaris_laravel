<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\JenisDokumen;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Setup');
        $request->session()->put('child', 'Pegawai');
        return view('pages.pegawai.index');
    }



    public function getServerSide()
    {

        $peg = Pegawai::with('jabatan')->orderby('nama')->get();

        return DataTables::of($peg)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a href="/pegawai/' . $row->id . '" class="btn btn-primary" style="font-size:12px; color:white;">Dokumen</a>
                <a href="/pegawai/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
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
        $jabatan = Jabatan::orderby('jabatan')->get();

        return view('pages.pegawai.create', compact('action',  'jabatan'));
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
        $maxno = Pegawai::max('no');
        $generateNomor = 'PEG-';
        if ($maxno < 10)
            $kode = $generateNomor . '00' . ($maxno + 1);
        else if ($maxno < 99)
            $kode = $generateNomor . '0' . ($maxno + 1);
        else
            $kode = $generateNomor . ($maxno + 1);

        $cek = Pegawai::where('no_identitas', $request->no_identitas)->get();

        if (count($cek) > 0) {
            Alert::warning('Warning!', 'No Identitas tersebut telah digunakan');
            return Redirect::to('/pegawai/create')->withErrors(['No Identitas tersebut telah digunakan.'])->withInput();
        } else {
            $foto = null;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = public_path() . '/uploads/';
                $foto = 'foto_pegawai_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $foto);
            }
            Pegawai::create([
                "no" => ($maxno + 1),
                "kode" => $kode,
                "jabatan_id" => $request->jabatan_id,
                "nama" => $request->nama,
                "no_identitas" => $request->no_identitas,
                "alamat" => $request->alamat,
                "no_hp" => $request->no_hp,
                "pin" => $request->pin,
                "is_absen" => $request->is_absen,
                "foto" => $foto,
            ]);
            Alert::success('Success!', 'Data Pegawai Added!');
            return Redirect::to('/pegawai');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        $action = 'edit';
        $jabatan = Jabatan::orderby('jabatan')->get();

        return view('pages.pegawai.dokumen', compact('action',  'jabatan', 'pegawai'));
    }

    public function tambah_dokumen(Request $request)
    {
        // return $request;
        $cek = JenisDokumen::where('nama', $request->nama)->where('pegawai_id', $request->pegawai_id)->get();

        if (count($cek) > 0) {
            Alert::warning('Warning!', 'Dokumen tersebut telah digunakan');
            return Redirect::to('/pegawai/' . $request->pegawai_id)->withErrors(['Dokumen tersebut telah digunakan.'])->withInput();
        } else {
            $file_dok = null;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = public_path() . '/uploads/';
                $file_dok = 'file_dok_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $file_dok);
            }
            JenisDokumen::create([
                "pegawai_id" => $request->pegawai_id,
                "nama" => $request->nama,
                "jenis" => $request->jenis,
                "tanggal" => $request->tanggal,
                "nomor" => $request->nomor,
                "file" => $file_dok,
            ]);
            Alert::success('Success!', 'Dokumen Pegawai Added!');
            return Redirect::to('/pegawai/' . $request->pegawai_id);
        }

        // return view('pages.pegawai.dokumen', compact('action',  'jabatan', 'pegawai'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $action = 'edit';
        $jabatan = Jabatan::orderby('jabatan')->get();

        return view('pages.pegawai.create', compact('action',  'jabatan', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        // return $request;
        $path = public_path() . '/uploads/';
        $foto = $pegawai->foto;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $foto = 'foto_pegawai_' . time() . '.' . $image->getClientOriginalExtension();
            if (file_exists($path . $pegawai->foto) && $pegawai->foto != null)
                unlink($path . $pegawai->foto);
            $image->move($path, $foto);
        }

        if ($pegawai->no_identitas == $request->no_identitas) {
            $pegawai->jabatan_id = $request->jabatan_id;
            $pegawai->nama = $request->nama;
            $pegawai->alamat = $request->alamat;
            $pegawai->no_hp = $request->no_hp;
            $pegawai->pin = $request->pin;
            $pegawai->foto = $foto;
            $pegawai->is_absen = $request->is_absen;
            $pegawai->save();
        } else {
            $cek = Pegawai::where('no_identitas', $request->no_identitas)->get();
            if (count($cek) > 0) {
                Alert::warning('Warning!', 'No Identitas tersebut telah digunakan');
                return Redirect::to('/pegawai/create')->withErrors(['No Identitas tersebut telah digunakan.'])->withInput();
            } else {
                $pegawai->jabatan_id = $request->jabatan_id;
                $pegawai->nama = $request->nama;
                $pegawai->alamat = $request->alamat;
                $pegawai->no_hp = $request->no_hp;
                $pegawai->no_identitas = $request->no_identitas;
                $pegawai->pin = $request->pin;
                $pegawai->foto = $foto;
                $pegawai->is_absen = $request->is_absen;
                $pegawai->save();
            }
        }
        Alert::success('Success!', 'Data Barang Updated!');
        return Redirect::to('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $path = public_path() . '/inventaris/public/uploads/';
        if (file_exists($path . $pegawai->foto) && $pegawai->foto != null)
            unlink($path . $pegawai->foto);
        $pegawai->delete();
    }

    public function hapus_dokumen($id)
    {
        $data = JenisDokumen::where('id', $id)->first();
        $path = public_path() . '/inventaris/public/uploads/';
        if (file_exists($path . $data->file) && $data->file != null)
            unlink($path . $data->file);
        $data->delete();
    }
}
