<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KwitansiDetail extends Model
{
    protected $table = 'kwitansi_det';
    protected $guarded = [];
    protected $dates = ['created_at'];
}
