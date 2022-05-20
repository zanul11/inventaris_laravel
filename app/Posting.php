<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $table = 'posting_absen';
    protected $guarded = [];


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id', 'id');
    }
}
