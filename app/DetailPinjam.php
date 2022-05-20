<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPinjam extends Model
{
    protected $table = 'detail_log_pinjam';
    protected $guarded = [];


    public function alat()
    {
        return $this->belongsTo('App\Peralatan', 'peralatan_id', 'id');
    }

    public function detail()
    {
        return $this->belongsTo('App\Pinjam', 'kode', 'kode');
    }
}
