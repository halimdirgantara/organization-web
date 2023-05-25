<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $organizations = Organization::pluck('id')->where('id','1')->first();
        // $user = User::pluck('id')->where('id','1')->first();
        Tag::create([
            'name' => 'PEMKAB_SEKADAU',
            'slug' => 'pemkab-sekadau',
            'organization_id' =>1,
            'created_by'=>1,
        ]);
        Tag::create([
            'name' => 'SEKADAU',
            'slug' => 'sekadau',
            'organization_id' =>1,
            'created_by'=>1,
        ]);
        Tag::create([
            'name' => 'BerAKHLAK',
            'slug' => 'berakhlak',
            'organization_id' =>1,
            'created_by'=>1,
        ]);
    }
}
