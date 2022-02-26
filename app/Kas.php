<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';
    protected $guarded = [];
    protected $dates = ['created_at', 'tgl'];

    public function kwitansi()
    {
        return $this->hasMany('App\Kwitansi', 'kode_kas', 'kode');
    }
}
