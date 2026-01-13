<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin Desa Nyeni',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => 1 // Admin
        ]);

        User::create([
            'id' => 2,
            'name' => 'Penduduk 1',
            'email' => 'penduduk1@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => 2 // User
        ]);

        User::create([
            'id' => 3,
            'name' => 'Kades Desa Nyeni',
            'email' => 'kades@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => 3 // Kades
        ]);

        User::create([
            'id' => 4,
            'name' => 'RT01 SiDesa',
            'email' => 'rt01@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => 4 // RT/RW
        ]);

        Resident::create([
            'user_id' => 2,
            'nik' => '3508123123324567',
            'name' => 'Penduduk 1',
            'gender' => 'male',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',

            'address' => 'Jl. Contoh No. 1',
            'marital_status' => 'single',
        ]);

        Resident::create([
            'user_id' => 3,
            'nik' => '3503210987654321',
            'name' => 'Kades Desa Nyeni',
            'gender' => 'male',
            'birth_date' => '1980-12-12',
            'birth_place' => 'Bandung',
            'address' => 'Jl. Contoh No. 3',
            'marital_status' => 'married',
        ]);

        Resident::create([
            'user_id' => 4,
            'nik' => '3508123123324567',
            'name' => 'RT01 Desa Nyeni',
            'gender' => 'male',
            'birth_date' => '1990-05-15',
            'birth_place' => 'Surabya',
            'address' => 'Jl. Contoh No. 2',
            'rt' => '01',
            'rw' => '01',
            'marital_status' => 'married',
        ]);
    }
}
