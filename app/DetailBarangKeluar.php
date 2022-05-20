<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBarangKeluar extends Model
{
    protected $table = 'detail_barang_keluar';
    protected $guarded = [];
    protected $dates = ['created_at'];


    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id', 'id');
    }

    public function proyek()
    {
        return $this->belongsTo('App\Proyek', 'proyek_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne('App\BarangKeluar', 'kode', 'log_kode');
    }
}
