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

    public function customerOrderProducts()
    {
        return $this->hasMany(CustomerOrderProduct::class);
    }

    //action
    public function createOrder($customerId, $deliverDate)
    {
        $number = Helper::IDGenerator(new CustomerOrder(), 'number', 2, 'CUST_ODR');

        $this->number = $number;
        $this->customer_id = $customerId;
        $this->deliver_date = $deliverDate;
        $this->save();
    }
}
