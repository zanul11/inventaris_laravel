<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'keuangan';
    protected $guarded = [];

    public function jenis_akunting()
    {
        return $this->belongsTo('App\JenisAkunting', 'jenis_akunting_id', 'id');
    }
}
