<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::create([
            'name' => 'default-image',
            'slug' => 'default-image',
            'file' => 'public/images/image-default/default-image.png',
            'file_type' =>'image',
            'description'=>'default-image',
            'size'=>'15.0',
            'downloaded'=>0,
            'organization_id'=>'1',
            'created_by'=>'1',
        ]);
        File::create([
            'name' => 'default-image-women',
            'slug' => 'default-image-women',
            'file' => 'public/images/image-default/default-image-women.png',
            'file_type' =>'image',
            'description'=>'default-image-women',
            'size'=>'15.0',
            'downloaded'=>0,
            'organization_id'=>'1',
            'created_by'=>'1',
        ]);
        File::create([
            'name' => 'default-user-men',
            'slug' => 'default-user-men',
            'file' => 'public/images/image-default/default-user-men.png',
            'file_type' =>'image',
            'description'=>'default-user-men',
            'size'=>'15.0',
            'downloaded'=>0,
            'organization_id'=>'1',
            'created_by'=>'1',
        ]);
        File::create([
            'name' => 'LOGO-KABUPATEN-SEKADAU',
            'slug' => 'LOGO-KABUPATEN-SEKADAU',
            'file' => 'public/images/image-default/LOGO-KABUPATEN-SEKADAU.png',
            'file_type' =>'image',
            'description'=>'LOGO-KABUPATEN-SEKADAU',
            'size'=>'15.0',
            'downloaded'=>0,
            'organization_id'=>'1',
            'created_by'=>'1',
        ]);
    }
}
