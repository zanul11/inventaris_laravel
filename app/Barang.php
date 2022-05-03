<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    protected $table = 'barang';
    protected $guarded = [];
    protected $dates = ['tgl_beli'];
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    // use SoftDeletes;

    public function jenis_detail()
    {
        return $this->belongsTo('App\Jenis', 'jenis', 'id');
    }

    public function satuan_detail()
    {
        return $this->belongsTo('App\Satuan', 'satuan', 'id');
    }

    public function kartu_barang()
    {
        return $this->hasMany('App\BarangMasuk', 'barang_id', 'id');
    }
    public function barang_masuk()
    {
        return $this->hasMany('App\BarangMasuk', 'barang_id', 'id');
    }
    public function barang_keluar()
    {
        return $this->hasMany('App\DetailBarangKeluar', 'barang_id', 'id');
    }
}
