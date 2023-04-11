<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            'designation' => 'PHP',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe2',
        ]);

        Module::create([
            'designation' => 'NoSql',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe2',
        ]);


        Module::create([
            'designation' => 'GraphTheory',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe3',
        ]);

        Module::create([
            'designation' => 'C++',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe2',
        ]);

        Module::create([
            'designation' => 'Reseaux',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe3',
        ]);
    }
}
