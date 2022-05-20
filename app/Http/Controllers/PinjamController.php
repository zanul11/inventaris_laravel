<?php

namespace App\Http\Controllers;

use App\DetailPinjam;
use App\LogPeralatanMasuk;
use App\Peralatan;
use App\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Manajemen Peralatan');
        $request->session()->put('child', 'Peminjaman');
        return view('pages.pinjam.index');
    }

    public function getServerSide()
    {

        $data = Pinjam::with('peralatans')->orderby('status')->orderby('tgl_batas')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('batas', function ($row) {
                return $row->tgl_batas->format('d/m/Y');
            })
            ->addColumn('proyek_detail', function ($row) {
                return $row->proyek->nama ?? '-';
            })
            ->addColumn('daftar_barang', function ($row) {
                $tmp = '';
                if (count($row->peralatans) < 2) {
                    foreach ($row->peralatans as $dt) {
                        $tmp .= $dt['alat']->nama . ' (' . $dt['jumlah'] . ') ';
                    }
                } else {
                    foreach ($row->peralatans as $dt) {
                        $tmp .= $dt['alat']->nama . ' (' . $dt['jumlah'] . ') |';
                    }
                }

                return $tmp;
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                if ($row->status == 0) {
                    $btn = '<div class="btn-group btn-group-sm" role="group">
                    <a href="/pinjam/' . $row->id . '" class="btn btn-success" style="font-size:12px; color:white;">Pengembalian</a>
                    <a href="/pinjam/' . $row->id . '/edit" class="btn btn-warning" style="font-size:12px; color:white;">Edit</a>
                    <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
                </div>';
                }

                return $btn;
            })
            ->make();
    }


    public function getSelectedAlat(Request $request)
    {

        $det = DB::table('detail_log_pinjam')
            ->join('peralatan', 'detail_log_pinjam.peralatan_id', '=', 'peralatan.id')
            ->join('satuan', 'satuan.id', '=', 'peralatan.satuan')
            ->select('detail_log_pinjam.*', 'peralatan.nama', 'satuan.satuan', 'satuan.id as satuan_id')
            ->where('detail_log_pinjam.kode', $request->kode)->where('status', 0)
            ->get();
        return $det;
    }
    public function getKembalainAlat(Request $request)
    {

        $det = DB::table('detail_log_pinjam')
            ->join('peralatan', 'detail_log_pinjam.peralatan_id', '=', 'peralatan.id')
            ->join('satuan', 'satuan.id', '=', 'peralatan.satuan')
            ->select('detail_log_pinjam.*', 'peralatan.nama', 'satuan.satuan', 'satuan.id as satuan_id')
            ->where('detail_log_pinjam.kode', $request->kode)->where('status', 1)
            ->get();
        return $det;
    }

    public function pinjamKembali(Request $request)
    {

        $pinjam = DetailPinjam::with('detail')->with('alat')->where('id', $request->id)->first();

        //get data update for rusak n stok aktif
        $stok_aktif = $pinjam['alat']['stok_aktif'] + $pinjam['jumlah'] - $request->rusak;
        $rusak = $pinjam['alat']['rusak'] + $request->rusak;

        //update log rusak jika ada rusak
        if ($request->rusak > 0) {
            LogPeralatanMasuk::create([
                "peralatan_id" => $pinjam['alat']['id'],
                "jumlah" => $request->rusak,
                "pj" =>  $pinjam['detail']['pj'],
                "ket" => $request->ket,
                "tgl" => date('Y-m-d'),
                "jenis" => 0,
                "kode" => $pinjam['detail']['kode']
            ]);
        }
        //update detail peminjaman alat
        DetailPinjam::where('id', $request->id)
            ->update([
                'status' => 1,
                'rusak' => $request->rusak,
                'ket' => $request->ket
            ]);

        $cek_sisa_pinjaman = DetailPinjam::where('kode', $pinjam['detail']['kode'])->where('status', 0)->get();
        if (count($cek_sisa_pinjaman) == 0) {
            Pinjam::where('kode', $pinjam['detail']['kode'])
                ->update(['status' => 1]);
        }

        //update peralatan
        Peralatan::where('id', $pinjam['alat']['id'])
            ->update([
                'stok_aktif' => $stok_aktif,
                'rusak' => $rusak,

            ]);

        return count($cek_sisa_pinjaman);
    }

    public function pinjamHapus(Request $request)
    {
        $pinjam = DetailPinjam::with('detail')->with('alat')->where('id', $request->id)->first();

        //get data update for rusak n stok aktif
        $stok_aktif = $pinjam['alat']['stok_aktif'] - $pinjam['jumlah'] + $pinjam['rusak'];
        $rusak = $pinjam['alat']['rusak'] - $pinjam['rusak'];


        //update log rusak jika ada rusak
        if ($pinjam['rusak'] > 0) {
            LogPeralatanMasuk::where('kode', $pinjam['detail']['pj'])->where("peralatan_id", $pinjam['alat']['id'])->delete();
        }

        //update detail peminjaman alat
        DetailPinjam::where('id', $request->id)
            ->update([
                'status' => 0,
            ]);

        //update peralatan
        Peralatan::where('id', $pinjam['alat']['id'])
            ->update([
                'stok_aktif' => $stok_aktif,
                'rusak' => $rusak,
            ]);
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maxno = Pinjam::max('no');
        $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $generateNomor = '/LGSTK.PRLT.PJM/' . $bulanRomawi[date("n")] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;
        $action = 'add';
        return view('pages.pinjam.create', compact('action', 'kode'));
    }

    public function getAlat()
    {
        $alat = Peralatan::with('satuan_detail')->get();
        return $alat;
    }

    public function getAlatById($id)
    {
        $alat = Peralatan::with('satuan_detail')->where('id', $id)->first();
        return $alat;
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
        $maxno = Pinjam::max('no');
        $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $generateNomor = '/LGSTK.PRLT.PJM/' . $bulanRomawi[date("n")] . '/' . date('Y');
        if ($maxno < 10)
            $kode = '00' . ($maxno + 1) . $generateNomor;
        else if ($maxno < 99)
            $kode =  '0' . ($maxno + 1) . $generateNomor;
        else
            $kode = ($maxno + 1) . $generateNomor;


        foreach ($request->peralatans as $dt) {
            $alat = Peralatan::where('id', $dt['barang_id'])->first();
            $sisa = ($alat['stok_aktif'] - $dt['jumlah']);
            DB::table('peralatan')
                ->where('id', $dt['barang_id'])
                ->update(['stok_aktif' => $sisa]);
            DetailPinjam::create([
                "kode" => $kode,
                "peralatan_id" => $dt['barang_id'],
                "jumlah" => $dt['jumlah'],
                "proyek_id" => $request->proyek
            ]);
        }
        Pinjam::create([
            "no" => ($maxno + 1),
            "kode" => $kode,
            "pj" => $request->pj,
            "lokasi" => $request->lokasi,
            "tgl_batas" => date('Y-m-d', strtotime($request->tgl . ' +1 day')),
            "proyek_id" => $request->proyek
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjam $pinjam)
    {
        return view('pages.pinjam.kembali', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjam $pinjam)
    {
        return view('pages.pinjam.edit', compact('pinjam'));
    }

    public function edits(Request $request)
    {
        // return $request;

        $rollback_data = DetailPinjam::where('kode', $request->kode)->get();
        foreach ($rollback_data as $dt) {
            $alat = Peralatan::where('id', $dt['peralatan_id'])->first();
            $stok_aktif = ($alat['stok_aktif'] + $dt['jumlah']);
            DB::table('peralatan')
                ->where('id', $dt['peralatan_id'])
                ->update(['stok_aktif' => $stok_aktif]);
            DB::table('detail_log_pinjam')
                ->where('peralatan_id', $dt['peralatan_id'])
                ->where('kode', $request->kode)
                ->delete();
        }

        foreach ($request->peralatans as $dt) {
            $alat = Peralatan::where('id', $dt['barang_id'])->first();
            $sisa = ($alat['stok_aktif'] - $dt['jumlah']);
            DB::table('peralatan')
                ->where('id', $dt['barang_id'])
                ->update(['stok_aktif' => $sisa]);
            DetailPinjam::create([
                "kode" => $request->kode,
                "peralatan_id" => $dt['barang_id'],
                "jumlah" => $dt['jumlah'],
                "proyek_id" => $request->proyek
            ]);
        }
        Pinjam::where('kode', $request->kode)
            ->update([
                "pj" => $request->pj,
                "lokasi" => $request->lokasi,
                "tgl_batas" => date('Y-m-d', strtotime($request->tgl)),
                "proyek_id" => $request->proyek
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjam $pinjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjam $pinjam)
    {
        $rollback_data = DetailPinjam::where('kode', $pinjam->kode)->get();
        foreach ($rollback_data as $dt) {
            $alat = Peralatan::where('id', $dt['peralatan_id'])->first();
            $stok_aktif = ($alat['stok_aktif'] + $dt['jumlah']);
            DB::table('peralatan')
                ->where('id', $dt['peralatan_id'])
                ->update(['stok_aktif' => $stok_aktif]);
            DB::table('detail_log_pinjam')
                ->where('peralatan_id', $dt['peralatan_id'])
                ->where('kode', $pinjam->kode)
                ->delete();
        }
        $pinjam->delete();
    }
}
