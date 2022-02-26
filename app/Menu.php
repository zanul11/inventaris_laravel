<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'kd_menu';
    public $incrementing = false;
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
