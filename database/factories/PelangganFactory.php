<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pelanggan;
use Faker\Generator as Faker;

$factory->define(Pelanggan::class, function (Faker $faker) {
    return [
        'nik' => $faker->userName,
        'nama' => $faker->unique()->userName,
        'alamat' => $faker->address,
        'no_hp' => '081999888777',
        'ket' => 'ket tes'
    ];
});
