<?php

namespace App\Models;

use App\Support\ImageUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = ['title', 'description', 'image', 'sort_order'];

    protected $casts = ['sort_order' => 'integer'];

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => ImageUrl::resolve($this->image));
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
