<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelengkapan extends Model
{
    protected $table = 'kelengkapan';
    protected $guarded = [];

    public function satuan()
    {
        return $this->belongsTo('App\Satuan', 'id_satuan', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo('App\Lokasi', 'id_lokasi', 'id');
    }
}
