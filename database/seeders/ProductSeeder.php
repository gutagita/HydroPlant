<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Benih Selada Hidroponik',
                'description' => 'Benih selada khusus untuk sistem hidroponik, tumbuh cepat dan segar',
                'price' => 25000,
                'stock' => 50,
                'images' => json_encode(['selada1.jpg', 'selada2.jpg']),
                'category_id' => 2, // Benih Tanaman
                'is_featured' => true
            ],
            [
                'name' => 'Kit Hidroponik NFT Starter',
                'description' => 'Kit lengkap untuk memulai hidroponik sistem NFT, cocok untuk pemula',
                'price' => 450000,
                'stock' => 15,
                'images' => json_encode(['kit1.jpg', 'kit2.jpg']),
                'category_id' => 3, // Kit Hidroponik
                'is_featured' => true
            ],
            [
                'name' => 'Bibit Pakcoy Unggul',
                'description' => 'Bibit pakcoy unggulan dengan ketahanan penyakit tinggi',
                'price' => 18000,
                'stock' => 30,
                'images' => json_encode(['pakcoy1.jpg']),
                'category_id' => 1, // Bibit Tanaman
                'is_featured' => false
            ],
            [
                'name' => 'Paket Usaha Hidroponik 10m²',
                'description' => 'Paket lengkap untuk memulai usaha hidroponik skala rumahan',
                'price' => 2500000,
                'stock' => 5,
                'images' => json_encode(['paket1.jpg', 'paket2.jpg', 'paket3.jpg']),
                'category_id' => 4, // Paket Usaha
                'is_featured' => true
            ]
        ]);
    }
}