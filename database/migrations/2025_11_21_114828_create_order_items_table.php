<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->cascadeOnDelete();
                $table->foreignId('product_id')->constrained()->cascadeOnDelete();
                $table->integer('quantity');
                $table->decimal('unit_amount', 15, 2); // ubah jadi:
                $table->decimal('unit_amount', 15, 2)->default(0);
                $table->decimal('total_amount', 15, 2)->default(0);
                $table->timestamps();
            });


            // relasi ke orders
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // relasi ke products
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // jumlah barang yang dibeli
            $table->integer('quantity')->default(1);

            // harga satuan produk
            $table->decimal('price', 10, 2);

            // total harga untuk item ini (price * quantity)
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
