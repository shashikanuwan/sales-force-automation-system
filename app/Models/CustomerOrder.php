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

    // accessors
    public function getFreeIssueAttribute()
    {
        if ($this->product->linefree) {
            if ($this->product->linefree->type == "Flat") {
                if ($this->product->linefree->lower_limit <= $this->quantity and $this->quantity <= $this->product->linefree->uper_limit) {
                    return $this->product->Linefree->free_quantity;
                }
                return  "No free issue";
            }
            if ($this->product->linefree->lower_limit <= $this->quantity and $this->quantity <= $this->product->linefree->uper_limit) {
                return intval($this->quantity / $this->product->linefree->purchase_quantity * $this->product->linefree->free_quantity);
            }
            return  "No free issue";
        }
        return "-";
    }

    public function getFreeQuantityAttribute()
    {
        if ($this->product->linefree) {
            return $this->product->linefree->free_quantity;
        }
        return "-";
    }

    public function getTypeAttribute()
    {
        if ($this->product->linefree) {
            return $this->product->linefree->type;
        }
        return "-";
    }

    public function getPurchaseQuantityAttribute()
    {
        if ($this->product->linefree) {
            return $this->product->linefree->purchase_quantity;
        }
        return "-";
    }
}
