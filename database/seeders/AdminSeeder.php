<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'fadil',
            'email' => 'fadil.oussa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('abc123'),
            'role' => 'Admin',
        ]);


        User::create([
            'name' => 'Amechnoue',
            'email' => 'kamechnoue@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('php'),
            'role' => 'Teacher',
        ]);

        User::create([
            'name' => 'Maouen',
            'email' => 'Maouen@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('graph'), // password
            'role' => 'Teacher',
        ]);


        User::create([
            'name' => 'jellouli',
            'email' => 'yassine@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), // password
            'role' => 'Student',
        ]);

        User::create([
            'name' => 'lagzal',
            'email' => 'mohammed@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
            'role' => 'Student',
        ]);
        User::create([
            'name' => 'khayat',
            'email' => 'iliass@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // password
            'role' => 'Student',
        ]);


        User::create([
            'name' => 'Badir',
            'email' => 'hassan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('nosql'), // password
            'role' => 'Teacher',
        ]);
    }
}
