<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrganizationSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            FileSeeder::class,
            SocialMediaSeeder::class,
            TagSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            SyncRoleAndPermissionSeeder::class,
            SyncUserandRole::class,
        ]);
    }
}
