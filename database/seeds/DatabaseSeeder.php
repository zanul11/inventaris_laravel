<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(UserSeeder::class);
        User::truncate();
        $diaz_seller = User::create([
            'nama' => 'Administrator',
            'user' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'alamat' => '-',
        ]);
    }
}
