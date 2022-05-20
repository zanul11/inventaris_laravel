<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TidakHadir extends Model
{
    protected $table = 'tidak_masuk';
    protected $guarded = [];


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo('App\JenisIzin', 'jenis_id', 'id');
    }
}
