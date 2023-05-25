<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

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
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
            'is_online' => '0',
            'is_active' => '1',
        ]);
        $organizations = Organization::pluck('id')->toArray();
        
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'nip' => $faker->unique()->numberBetween(100000, 999999),
                'nik' => $faker->unique()->numberBetween(100000, 999999),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Ganti dengan password yang diinginkan
                'organization_id' => $faker->randomElement($organizations),
                'is_online' => $faker->boolean,
                'is_active' => $faker->boolean,
            ]);
        }
    }
}
