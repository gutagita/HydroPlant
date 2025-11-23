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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        // relasi ke users
        $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();

        // total pembayaran
        $table->decimal('grand_total', 10, 2)->nullable();

        // metode & status pembayaran
        $table->string('payment_method')->nullable();
        $table->string('payment_status')->nullable();

        // status pesanan
        $table->enum('status', [
            'diproses',
            'dikirim',
            'diterima',
            'dibatalkan'
        ])->default('diproses');

        // pengiriman
        $table->string('currency')->nullable();
        $table->decimal('shipping_amount', 10, 2)->nullable();
        $table->string('shipping_method')->nullable();

        // catatan tambahan
        $table->text('notes')->nullable();

        // timestamps created_at & updated_at
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
