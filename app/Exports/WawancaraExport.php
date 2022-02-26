<?php

namespace App\Exports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Gelombang;

class WawancaraExport implements FromView
{
    public function view(): View
    {
        $gelombang = Gelombang::where('dari', '<=', date('m'))->where('sampai', '>=', date('m'))->first();
        $siswa = Siswa::with('jurusan')->whereYear('tgl_masuk', date('Y'))->where('gelombang', $gelombang->gelombang)->orderBy('nama')->get();
        return view(
            'pages.verifikasi.wawancara-excel',
            [
                'siswa' => $siswa
            ]
        );
    }
}
