<?php

namespace App\Http\Controllers;

use App\Jabatan;
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

        $peg = Pegawai::orderby('nama')->get();

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
            Pegawai::create([
                "no" => ($maxno + 1),
                "kode" => $kode,
                "jabatan_id" => $request->jabatan_id,
                "nama" => $request->nama,
                "no_identitas" => $request->no_identitas,
                "alamat" => $request->alamat,
                "no_hp" => $request->no_hp,
                "pin" => $request->pin,
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
        //
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
        if ($pegawai->no_identitas == $request->no_identitas) {
            $pegawai->jabatan_id = $request->jabatan_id;
            $pegawai->nama = $request->nama;
            $pegawai->alamat = $request->alamat;
            $pegawai->no_hp = $request->no_hp;
            $pegawai->pin = $request->pin;
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
        $pegawai->delete();
    }
}
