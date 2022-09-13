<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    public const PENDING = 'pending';
    public const STARTED = 'started';
    public const COMPLETED = 'completed';

    // relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function createOrder($quantities, $customerId, $productID, $deliverDates)
    {
        $number = Helper::IDGenerator(new CustomerOrder(), 'number', 2, 'CUST_ODR');

        $this->number = $number;
        $this->quantity = $quantities;
        $this->customer_id = $customerId;
        $this->product_id = $productID;
        $this->deliver_date = $deliverDates;
        $this->save();
    }
}
