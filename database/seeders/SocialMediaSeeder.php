<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialMedia::create([
            'name' => 'Youtube Madah Sekadau',
            'url' => 'https://www.youtube.com/@madahsekadau',
            'icon' => 'public/images/icon-social-media/youtube.png',
            'order' => '1',
            'is_active' => '1',
            'organization_id' => '1',
            'created_by' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Facebook Madah Sekadau',
            'url' => 'https://www.facebook.com/MadahSekadau',
            'icon' => 'public/images/icon-social-media/facebook.png',
            'order' => '1',
            'is_active' => '1',
            'organization_id' => '1',
            'created_by' => '1',
        ]);
        SocialMedia::create([
            'name' => 'Instagram Madah Sekadau',
            'url' => 'https://www.instagram.com/madahsekadau',
            'icon' => 'public/images/icon-social-media/instagram.png',
            'order' => '1',
            'is_active' => '1',
            'organization_id' => '1',
            'created_by' => '1',
        ]);
    }
}
