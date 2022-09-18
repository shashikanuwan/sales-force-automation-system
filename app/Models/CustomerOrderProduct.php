<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relationships
    public function customerOrder()
    {
        return $this->belongsTo(CustomerOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // accessors
    public function getTotalAttribute()
    {
        return $this->product->mrp * $this->quantity;
    }
}
