<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table = 'saldo';
    protected $guarded = [];
    protected $dates = ['created_at', 'tgl'];
}
