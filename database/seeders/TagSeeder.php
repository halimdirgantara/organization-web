<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'name' => 'PEMKAB_SEKADAU',
            'slug' => 'pemkab-sekadau',
            'organization_id' =>'1',
            'created_by'=>'1',
        ]);
        Tag::create([
            'name' => 'SEKADAU',
            'slug' => 'sekadau',
            'organization_id' =>'1',
            'created_by'=>'1',
        ]);
        Tag::create([
            'name' => 'BerAKHLAK',
            'slug' => 'berakhlak',
            'organization_id' =>'1',
            'created_by'=>'1',
        ]);
    }
}
