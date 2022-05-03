<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $guarded = [];


    public function dokumen()
    {
        return $this->hasMany('App\JenisDokumen', 'pegawai_id', 'id');
    }
}
