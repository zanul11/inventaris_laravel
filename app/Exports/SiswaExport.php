<?php

namespace App\Exports;

use App\Mapel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class SiswaExport implements FromView
{

    protected $kode;

    function __construct($kode)
    {
        $this->kode = $kode;
    }

    public function view(): View
    {
        $mapel = Mapel::where('kode', $this->kode)->first();
        return view(
            'excel.siswa',
            [
                'mapel' => $mapel
            ]
        );
    }
}
