<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $table = 'peralatan';
    protected $guarded = [];


    public function jenis_detail()
    {
        return $this->belongsTo('App\Jenis', 'jenis_id', 'id');
    }

    public function satuan_detail()
    {
        return $this->belongsTo('App\Satuan', 'satuan', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo('App\Lokasi', 'lokasi_id', 'id');
    }
}
