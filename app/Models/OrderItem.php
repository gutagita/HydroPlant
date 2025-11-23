<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Hitung total otomatis saat membuat item
    protected static function booted()
    {
        static::creating(function ($item) {
            $item->price = $item->product?->price ?? 0;
            $item->total = $item->price * $item->quantity;
        });
    }
}
