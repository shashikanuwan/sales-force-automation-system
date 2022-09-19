<?php

namespace App\Observers;

use App\Models\DistributorOrderProduct;

class DistributorOrderProductObserver
{
    public function created(DistributorOrderProduct $distributorOrderProduct)
    {
        $quantity = $distributorOrderProduct->product->quantity - $distributorOrderProduct->quantity;

        $distributorOrderProduct->product->update([
            'quantity' => $quantity
        ]);
    }

    public function updated(DistributorOrderProduct $distributorOrderProduct)
    {
    }

    public function deleted(DistributorOrderProduct $distributorOrderProduct)
    {
        $quantity = $distributorOrderProduct->product->quantity + $distributorOrderProduct->quantity;

        $distributorOrderProduct->product->update([
            'quantity' => $quantity
        ]);
    }

    public function restored(DistributorOrderProduct $distributorOrderProduct)
    {
    }

    public function forceDeleted(DistributorOrderProduct $distributorOrderProduct)
    {
    }
}
