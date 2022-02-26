<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    protected $table = 'kwitansi';
    protected $guarded = [];
    protected $dates = ['created_at', 'tgl'];


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pj', 'nip');
    }

    public function bidang()
    {
        return $this->belongsTo('App\Bidang', 'diterima', 'kd_bagian');
    }

    public function kwitansis()
    {
        return $this->hasMany('App\KwitansiDetail', 'kode', 'kode');
    }
    public function jenis_det()
    {
        return $this->hasOne('App\JenisKwitansi', 'id', 'jenis');
    }
}
