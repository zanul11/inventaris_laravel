<?php

namespace App\Http\Controllers;

use App\JenisAkunting;
use App\LogKoreksi;
use App\Pengeluaran;
use App\User;
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
        if (Auth::user()->type == 5) {
            $data = Pengeluaran::with('jenis_akunting')->where('jenis', 0)->where('user', Auth::user()->nama)->orderby('updated_at', 'desc')->orderby('status', 'desc')->orderby('created_at', 'desc')->get();
        } else {
            $data = Pengeluaran::with('jenis_akunting')->where('jenis', 0)->orderby('updated_at', 'desc')->orderby('status', 'desc')->orderby('created_at', 'desc')->get();
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uang', function ($row) {
                return number_format($row->jumlah);
            })->addColumn('tgl_data', function ($row) {
                return date('d-m-Y', strtotime($row->tgl));
            })
            ->addColumn('action', function ($row) {
                if (Auth::user()->type == 4 || Auth::user()->type == 5) {
                    if ($row->status == 0) {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    } else if ($row->status == 2 || $row->status == 3) {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                    <a href="/pengeluaran/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    } else {
                        $btn = '<div class="btn-group btn-group-sm" role="group">
                        <a href="/pengeluaran/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
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
                    } else  if ($row->status == 0 || $row->status == 2 || $row->status == 3) {
                        $btn = '<div class="btn-group btn-group-sm" role="group"> 
                    <a href="/pengeluaran/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                   
                    <a href="/pengeluaran/' . $row->id . '" class="btn btn-success" style="font-size:12px; color:white;">Lihat</a>
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></div>';
                    } else {
                        $btn = '<div class="btn-group btn-group-sm" role="group"> 
                        <a href="/pengeluaran/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
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

        try {
            $foto = null;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = public_path() . '/uploads/';
                $foto = 'foto_pengeluaran_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $foto);
            }

            if ($request->status_pengeluaran == 'Pengajuan') {
                Pengeluaran::create([
                    'jenis_akunting_id' => $request->jenis_akunting_id,
                    'nama' => $request->nama,
                    'jenis' => 0,
                    'jumlah' => $request->jumlah,
                    'ket' => $request->ket,
                    'file' => $foto,
                    'status' => 0,
                    'tgl' => $request->tgl,
                    'user' => Auth::user()->nama,
                    'status_pengeluaran' => $request->status_pengeluaran,
                ]);
            } else {
                Pengeluaran::create([
                    'jenis_akunting_id' => $request->jenis_akunting_id,
                    'nama' => $request->nama,
                    'jenis' => 0,
                    'jumlah' => $request->jumlah,
                    'ket' => $request->ket,
                    'file' => $foto,
                    'status' => 4,
                    'tgl' => $request->tgl,
                    'user' => Auth::user()->nama,
                    'status_pengeluaran' => $request->status_pengeluaran,
                ]);
            }

            $user = User::whereIN('type', [1, 3])->get()->pluck('notif_id');
            $url = 'https://fcm.googleapis.com/fcm/send';
            $msg = [
                'title' => 'Konfirmasi Pengeluaran',
                'body' => $request->nama,

            ];
            $extra = ["message" => $msg];
            $fcm = [
                // "to" => "ctpT0CLkTe-P8MbWDPLaeg:APA91bHFg7WfGcH5eAMINnzj7rkpFmeBNLt_Bxq2i2PgJcKQhT57tmpxzmMTHokMfpdd3i_TR-Apdiv4yg5aulfN7NuSC5rhmk5y6-z3Zs4zqp3voUepwJeVI8VHcJQm2yud7XFZEC9_",
                "registration_ids" => $user,
                "notification" => $msg,
                "data" => $extra
            ];
            $headers = [
                'Authorization: key=AAAANhY-sD4:APA91bEsn-7Vmjo5gb9CXgEmAe3_BweSuNSzeiKhEOLo-q8yvYtUJnxqPSX4gVHPbus-wczjPKI3RjaZcUisNluSzIHQmsA_hsq1Kkk_8oVIQ7ViZupAYhYu2No1JvDMO4gaFs5F93cG',
                'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcm));
            $result = curl_exec($ch);
            curl_close($ch);

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
                if ($pengeluaran->status != 4) {
                    Pengeluaran::where('id', $pengeluaran->id)
                        ->update([
                            'jenis_akunting_id' => $request->jenis_akunting_id,
                            'nama' => $request->nama,
                            'jumlah' => $request->jumlah,
                            'ket' => $request->ket,
                            'file' => $foto,
                            'tgl' => $request->tgl,
                            'status' => ($pengeluaran->status != 3) ? 0 : 4,
                        ]);

                    LogKoreksi::create([
                        'keuangan_id' => $pengeluaran->id,
                        'ket' => ($pengeluaran->status != 3) ? 'Edit Koreksi' : 'Realisasi',
                        'user' => Auth::user()->nama,
                    ]);
                } else {
                    Pengeluaran::where('id', $pengeluaran->id)
                        ->update([
                            'jenis_akunting_id' => $request->jenis_akunting_id,
                            'nama' => $request->nama,
                            'ket' => $request->ket,
                            'tgl' => $request->tgl,
                            'file' => $foto,
                        ]);

                    LogKoreksi::create([
                        'keuangan_id' => $pengeluaran->id,
                        'ket' => 'Edit Pengeluaran yang sudah Realisasi',
                        'user' => Auth::user()->nama,
                    ]);
                }


                $user = User::whereIN('type', [1, 3])->get()->pluck('notif_id');
                $url = 'https://fcm.googleapis.com/fcm/send';
                $msg = [
                    'title' => 'Konfirmasi Revisi Pengeluaran',
                    'body' => $request->nama,

                ];
                $extra = ["message" => $msg];
                $fcm = [
                    // "to" => "ctpT0CLkTe-P8MbWDPLaeg:APA91bHFg7WfGcH5eAMINnzj7rkpFmeBNLt_Bxq2i2PgJcKQhT57tmpxzmMTHokMfpdd3i_TR-Apdiv4yg5aulfN7NuSC5rhmk5y6-z3Zs4zqp3voUepwJeVI8VHcJQm2yud7XFZEC9_",
                    "registration_ids" => $user,
                    "notification" => $msg,
                    "data" => $extra
                ];
                $headers = [
                    'Authorization: key=AAAANhY-sD4:APA91bEsn-7Vmjo5gb9CXgEmAe3_BweSuNSzeiKhEOLo-q8yvYtUJnxqPSX4gVHPbus-wczjPKI3RjaZcUisNluSzIHQmsA_hsq1Kkk_8oVIQ7ViZupAYhYu2No1JvDMO4gaFs5F93cG',
                    'Content-Type: application/json'
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcm));
                $result = curl_exec($ch);
                curl_close($ch);
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
