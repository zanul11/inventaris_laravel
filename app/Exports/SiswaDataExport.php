<?php

namespace App\Exports;

use App\Jurusan;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Siswa;

class SiswaDataExport implements FromView
{

    protected $jurusan;
    protected $angkatan;
    protected $gelombang;

    function __construct($jurusan, $angkatan, $gelombang)
    {
        $this->jurusan = $jurusan;
        $this->angkatan = $angkatan;
        $this->gelombang = $gelombang;
    }

    public function view(): View
    {
        $jurusan = Jurusan::where('nama', $this->jurusan)->first();
        $siswa = Siswa::with('jurusan')->where('gelombang', $this->gelombang)->where('angkatan', $this->angkatan)->where('jurusan_kode', $jurusan->kode)->orderBy('nama')->get();
        return view(
            'excel.siswa_data',
            [
                'siswa' => $siswa,
                'jurusan' => $this->jurusan,
                'angkatan' => $this->angkatan,
                'gelombang' => $this->gelombang
            ]
        );
    }
}
