<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin',
            'foto' => 'tes.ico',
            'nip' => '123456789',
            'alamat' => 'Jl. Kebon Kacang',
            'no_telp' => '08123456789',
            'email' => "admin@apreswa",
            'password' => bcrypt('admin'),
        ]);
    }
}
