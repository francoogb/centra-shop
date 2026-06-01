<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'discount_price', 'stock', 'image',
        'is_featured', 'is_active', 'is_book',
        'flash_sale', 'flash_sale_starts_at', 'flash_sale_ends_at',
    ];

    protected $casts = [
        'is_featured'        => 'boolean',
        'is_active'          => 'boolean',
        'is_book'            => 'boolean',
        'flash_sale'         => 'boolean',
        'price'              => 'decimal:0',
        'discount_price'     => 'decimal:0',
        'flash_sale_starts_at' => 'datetime',
        'flash_sale_ends_at'   => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Scope: products currently in an active flash sale window.
     */
    public function scopeActiveFlashSales($query)
    {
        $now = now();
        return $query->where('flash_sale', true)
                     ->where('is_active', true)
                     ->where(function ($q) use ($now) {
                         $q->whereNull('flash_sale_starts_at')
                           ->orWhere('flash_sale_starts_at', '<=', $now);
                     })
                     ->where(function ($q) use ($now) {
                         $q->whereNull('flash_sale_ends_at')
                           ->orWhere('flash_sale_ends_at', '>', $now);
                     });
    }
}
