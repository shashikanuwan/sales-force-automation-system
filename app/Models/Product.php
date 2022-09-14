<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relationships
    public function sku()
    {
        return $this->hasOne(Sku::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function linefree()
    {
        return $this->hasOne(LineFree::class);
    }
}
