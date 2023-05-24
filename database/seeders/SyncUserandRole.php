<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SyncUserandRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sA = User::find(1);
        $aSKPD = User::find(2);
        $editor = User::find(3);
        $verifikator = User::find(4);


        $sA->assignRole('Super Admin');
        $aSKPD->assignRole('Admin');
        $editor->assignRole('Editor');
        $verifikator->assignRole('Verifikator');
    }
}
