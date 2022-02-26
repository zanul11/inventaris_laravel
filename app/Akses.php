<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    protected $keyType = 'string';
    protected $fillable = [
        'user', 'kd_menu',
    ];

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'kd_menu', 'kd_menu');
    }
}
