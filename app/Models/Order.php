<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'notes',
    ];

    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hitung grand_total setelah order dibuat
    protected static function booted()
    {
        static::created(function ($order) {
            $order->grand_total = $order->orderItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $order->saveQuietly(); // save tanpa memicu event created lagi
        });
    }
}
