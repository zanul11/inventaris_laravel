<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasTmp extends Model
{
    protected $table = 'kas_tmp';
    protected $guarded = [];
    protected $dates = ['created_at'];

    public function kwitansi()
    {
        return $this->hasOne('App\Kwitansi', 'kode', 'kode');
    }
}
