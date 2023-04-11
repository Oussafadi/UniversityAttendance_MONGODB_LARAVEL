<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Filiere;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filiere::create([
            'Designation' => 'GINF01',
        ]);

        Filiere::create([
            'Designation' => 'GSTR01',
        ]);
    }
}
