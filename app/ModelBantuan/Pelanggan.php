<?php

namespace App\ModelBantuan;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $guarded = [];

    public function detail()
    {
        return $this->belongsTo('App\ModelBantuan\M_Pelanggan', 'pelanggan_ID', 'pelanggan_ID');
    }

    public function pembayaran()
    {
        return $this->hasMany('App\ModelBantuan\Pembayaran', 'pelanggan_ID', 'pelanggan_ID');
    }
}
