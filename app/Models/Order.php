<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const PENDING = 'pending';
    public const STARTED = 'started';
    public const COMPLETED = 'completed';

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function distributorOrderProducts()
    {
        return $this->hasMany(DistributorOrderProduct::class);
    }

    // accessors
    public function getDeliverDateAttribute($value)
    {
        return Carbon::parse($value)->format('M d, Y');
    }

    public function getTotalPriceAttribute()
    {
        $grandTotal = 0;
        foreach ($this->distributorOrderProducts as $distributorOrderProduct) {
            $grandTotal = $grandTotal + $distributorOrderProduct->total;
        }
        return  $grandTotal;
    }
}
