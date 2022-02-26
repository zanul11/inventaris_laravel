<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'personalia.pegawai';
    protected $guarded = [];
    protected $primaryKey = 'nip';
    public $incrementing = false;

    public function bidang()
    {
        return $this->belongsTo('App\Bidang', 'kd_bagian', 'kd_bagian');
    }
}
