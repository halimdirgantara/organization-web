<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'name' => 'Pemerintah Kabupaten Sekadau',
            'slug' => 'pemerintah-kabupaten-sekadau',
            'abbreviation' => 'Pemkab Sekadau',
            'description' => 'Web Pemerintah Kabupaten Sekadau',
            'address' => 'Merapi, RT. 05 / RW. 03, Sekadau Hilir, Gonis Tekam, Kec. Sekadau Hilir, Kabupaten Sekadau, Kalimantan Barat 79515',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kontak@surel.sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);
        Organization::create([
            'name' => 'Dinas Komunikasi dan Informatika',
            'slug' => 'dinas-komunikasi-dan-informatika',
            'abbreviation' => 'DisKomInfo',
            'description' => 'Web Dinas Komunikasi dan Informatika',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kantor Bupati Sekadau Lantai 2, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kontak@surel.sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);
    }
}
