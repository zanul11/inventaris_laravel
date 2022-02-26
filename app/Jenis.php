<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';
    protected $fillable = [
        'user', 'jenis',
    ];


    public function barangs()
    {
        return $this->hasMany('App\Barang', 'jenis');
    }
}
