<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absen';
    protected $guarded = [];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id', 'id');
    }
}
