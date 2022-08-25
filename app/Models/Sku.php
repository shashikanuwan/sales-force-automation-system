<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

    // relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
