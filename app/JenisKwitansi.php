<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKwitansi extends Model
{
    protected $table = 'jenis_kwitansi';
    protected $fillable = [
        'user', 'jenis',
    ];
}
