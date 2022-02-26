<?php

namespace App\Http\Controllers\Bantuan;

use App\Http\Controllers\Controller;
use App\ModelBantuan\M_Pelanggan;
use App\ModelBantuan\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Select2Controller extends Controller
{
    public function pelanggan(Request $request)
    {
        if ($request->has('key')) {
            $cari = str_replace(" ", "%", $request->key);
            $data = M_Pelanggan::query()
                ->whereRaw("concat(pelanggan_ID,' ',pelanggan_nama,' ',pelanggan_alamat) like '%" . $cari . "%'")
                ->take(10)
                ->get();
            return response()->json($data);
        }
        return response()->json([]);
    }

    public function bantuan(Request $request)
    {
        if ($request->has('key')) {
            $cari = str_replace(" ", "%", $request->key);
            $data = Pelanggan::query()
                ->whereRaw("concat(pelanggan_ID,' ',pelanggan_nama) like '%" . $cari . "%'")
                ->with('detail')
                ->take(10)
                ->get();
            return response()->json($data);
        }
        return response()->json([]);
    }

    public function pelangganAll()
    {
        return Pelanggan::with('detail')->get();
    }

    public function tagihan(Request $request)
    {
        $idPel = $request->pelanggan_ID;
        $tagihan = DB::select(DB::raw("select cBlth bulan, nStIni-nStLalu m3, nStIni stand, nHrgAir harga_air, nByAdm admin, nByRetrib retrib, nByMaterai materai, 
        CASE WHEN DATE(now())>CONCAT(YEAR(rekening_periode),'-', CASE WHEN DATE_FORMAT(rekening_periode,'%m')+1<10 THEN CONCAT('0',DATE_FORMAT(rekening_periode,'%m')+1)
        ELSE DATE_FORMAT(rekening_periode,'%m')+1 END,'-', 25) THEN 10000 ELSE 0 END denda, dTglBayar lunas, cKasir kasir, cKetWM ket,nJsLingk as lingkungan
          from rekening.m_rekening where cIdpel='$idPel' and lBayar=0"));
        return $tagihan;
    }
}
