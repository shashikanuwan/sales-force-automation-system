<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class EditOrder extends Component
{
    public Collection $products;
    public Collection $users;
    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->products = Product::query()
            ->get();

        $this->users = User::query()
            ->with(['territory'])
            ->role('distributor')
            ->get();
    }

    public function render()
    {
        return view('components.edit-order');
    }
}
