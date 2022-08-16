<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'keuangan';
    protected $guarded = [];

    public function jenis_akunting()
    {
        return $this->belongsTo('App\JenisAkunting', 'jenis_akunting_id', 'id');
    }

    public function log()
    {
        return $this->hasMany('App\LogKoreksi', 'keuangan_id', 'id')->orderBy('created_at', 'desc');
    }
}
