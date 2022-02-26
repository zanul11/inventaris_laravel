<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'log_barang';
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

    public function barangs()
    {
        return $this->hasMany('App\DetailBarangKeluar', 'log_kode', 'kode');
    }
}
