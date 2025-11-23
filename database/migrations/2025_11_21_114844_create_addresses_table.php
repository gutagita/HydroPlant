<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            // relasi ke orders
            $table->foreignId('order_id')
                ->constrained() // otomatis ke tabel orders
                ->cascadeOnDelete();

            $table->string('first_name');     // wajib diisi
            $table->string('last_name');      // wajib diisi
            $table->string('phone');          // wajib diisi
            $table->text('street_address');   // wajib diisi
            $table->string('city');           // wajib diisi
            $table->string('postal_code');    // wajib diisi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
