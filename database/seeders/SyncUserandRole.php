<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SyncUserandRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $su = User::find(1);
        $pd1 = User::find(2);
        $pd2 = User::find(3);


        $su->assignRole('Super Admin');
        $pd1->assignRole('Pimpinan Daerah');
        $pd2->assignRole('Pimpinan Daerah');
    }
}
