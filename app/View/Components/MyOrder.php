<?php

namespace App\View\Components;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MyOrder extends Component
{
    public Collection $orders;

    public function __construct()
    {
        $this->orders = Order::query()
            ->where('user_id', Auth::user()->id)
            ->with(['user.territory', 'sku.product'])
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('components.my-order');
    }
}
