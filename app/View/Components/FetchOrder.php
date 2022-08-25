<?php

namespace App\View\Components;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchOrder extends Component
{
    public Collection $orders;

    public function __construct()
    {
        $this->orders = Order::query()
            ->with(['sku.product', 'user.territory.region'])
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('components.fetch-order');
    }
}
