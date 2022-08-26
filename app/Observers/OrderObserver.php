<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    public function created(Order $order)
    {
        $quantity = $order->sku->product->quantity - $order->quantity;

        $order->sku->product->update([
            'quantity' => $quantity
        ]);
    }

    public function updated(Order $order)
    {

    }

    public function deleted(Order $order)
    {
        $quantity = $order->sku->product->quantity + $order->quantity;

        $order->sku->product->update([
            'quantity' => $quantity
        ]);
    }

    public function restored(Order $order)
    {

    }

    public function forceDeleted(Order $order)
    {

    }
}
