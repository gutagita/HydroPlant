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
  protected $appends = ['unit_amount', 'total_amount'];

// Getter/Setter alias untuk unit_amount <-> price
public function getUnitAmountAttribute()
{
    return $this->attributes['price'] ?? null;
}

public function setUnitAmountAttribute($value)
{
    $this->attributes['price'] = $value;
}

// Getter/Setter alias untuk total_amount <-> total
public function getTotalAmountAttribute()
{
    return $this->attributes['total'] ?? null;
}

public function setTotalAmountAttribute($value)
{
    $this->attributes['total'] = $value;
}
}
