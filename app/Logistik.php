<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logistik extends Model
{
    protected $table = 'logistik';
    protected $guarded = [];


    public function kelengkapan()
    {
        return $this->hasOne(Kelengkapan::class, 'id_logistik', 'id');
    }
}
