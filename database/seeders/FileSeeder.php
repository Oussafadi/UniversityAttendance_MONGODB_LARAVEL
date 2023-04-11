<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\File;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* File::create([
            'fileTitle' => 'photo',
            'fileName' => 'C:\Users\Fadio\Documents\photos\photo',
            'user_id'  => '642c0758e8b8e064730fe5e5'
        ]);
        */
        File::create([
            'fileTitle' => 'photoos',
            'fileName' => 'C:\Users\Fadio\Documents\photo.png',
            'user_id'  => '642c0758e8b8e064730fe5e3'
        ]);
    }
}
