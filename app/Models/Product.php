<?php

namespace App\Models;

use App\Support\ImageUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category', 'price', 'price_label', 'description', 'content',
        'image', 'lead_time', 'is_made_to_order', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_made_to_order' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Harga siap tampil: label manual dulu, lalu angka, terakhir "Harga sesuai pesanan".
    protected function formattedPrice(): Attribute
    {
        return Attribute::get(fn () => $this->price_label
            ?: ($this->price !== null ? 'Rp ' . number_format((float) $this->price, 0, ',', '.') : 'Harga sesuai pesanan'));
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => ImageUrl::resolve($this->image));
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
