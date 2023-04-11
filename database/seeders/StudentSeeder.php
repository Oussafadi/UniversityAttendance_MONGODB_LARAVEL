<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'firstName' => 'Yassine',
            'lastName' => 'Jellouli',
            'code_ap' => 19001,
            'admissionNumber' => '000001',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe2',
            'user_id' => '642c0758e8b8e064730fe5e5',
        ]);
        Student::create([
            'firstName' => 'Lagzal',
            'lastName' => 'Mohammed',
            'code_ap' => 19002,
            'admissionNumber' => '000002',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe2',
            'user_id' => '642c0758e8b8e064730fe5e6',
        ]);

        Student::create([
            'firstName' => 'Khayat',
            'lastName' => 'Iliass',
            'code_ap' => 19003,
            'admissionNumber' => '000002',
            'filiere_id' => '642c0d2cd9e4a5d7a9089fe3',
            'user_id' => '642c0758e8b8e064730fe5e7',
        ]);
    }
}
