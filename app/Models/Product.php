<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // relationships
    public function sku()
    {
        return $this->hasOne(Sku::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
