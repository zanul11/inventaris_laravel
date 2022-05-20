<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'log_pinjam';
    protected $guarded = [];
    protected $dates = ['created_at', 'tgl_batas'];



    public function peralatans()
    {
        return $this->hasMany('App\DetailPinjam', 'kode', 'kode');
    }

    public function proyek()
    {
        return $this->belongsTo('App\Proyek', 'proyek_id', 'id');
    }
}
