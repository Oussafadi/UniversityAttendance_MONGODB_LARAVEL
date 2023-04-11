<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'firstName' => 'Khalid',
            'lastName' => 'Amechnoue',
            'module_id' => '642c0fb83d5634baa904be02',
            'user_id' => '642c0758e8b8e064730fe5e3',
        ]);
        Teacher::create([
            'firstName' => 'Mounir',
            'lastName' => 'Maouen',
            'module_id' => '642c0fb83d5634baa904be04',
            'user_id' => '642c0758e8b8e064730fe5e4',
        ]);

        /*   Teacher::create([
            'firstName' => 'Mariam',
            'lastName' => 'Tanana',
            'module_id' => 4,
            'user_id' => 5,
        ]);
        */
    }
}
