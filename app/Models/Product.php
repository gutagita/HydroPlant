<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'images',
        'category_id',
        'is_featured'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean'
    ];

    // Relationship dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship dengan OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // aman kalau name kosong (filament kadang trigger saving tanpa data)
            if (!empty($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
