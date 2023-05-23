<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Profil',
            'slug' => 'profil',
            'description' => 'Kategori untuk menyimpan data profil organisasi',
            'organization_id' =>'1',
            'created_by' => '1',
        ]);
        Category::create([
            'name' => 'Berita',
            'slug' => 'berita',
            'description' => 'Kategori untuk menyimpan data berita organisasi',
            'organization_id' =>'1',
            'created_by' => '1',
        ]);
        Category::create([
            'name' => 'Pengumuman',
            'slug' => 'pengumuman',
            'description' => 'Kategori untuk menyimpan data pengumuman organisasi',
            'organization_id' =>'1',
            'created_by' => '1',
        ]);
    }
}
