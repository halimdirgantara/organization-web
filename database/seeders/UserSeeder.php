<?php

namespace Database\Seeders;

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
            'name' => 'Super Admin',
            'nip' => '12345678910',
            'nik' => '12345678910',
            'phone' => '6281251413425',
            'address' => 'Sekadau',
            'email' => 'kominfo@sekadaukab.go.id',
            'password' => bcrypt('KomInfo#2021'),
            'organization_id' => '1',
            'is_online' => '0',
            'is_active' => '1',
        ]);
    }
}
