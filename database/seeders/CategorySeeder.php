<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Bibit Tanaman', 'description' => 'Berbagai macam bibit tanaman hidroponik'],
            ['name' => 'Benih Tanaman', 'description' => 'Benih berkualitas untuk hidroponik'],
            ['name' => 'Kit Hidroponik', 'description' => 'Perlengkapan dan kit sistem hidroponik'],
            ['name' => 'Paket Usaha', 'description' => 'Paket lengkap untuk memulai usaha hidroponik'],
            ['name' => 'Sayuran Segar', 'description' => 'Hasil panen sayuran hidroponik segar'],
        ]);
    }
}