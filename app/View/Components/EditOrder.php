<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\Sku;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class EditOrder extends Component
{
    public Collection $skus;
    public Collection $users;
    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->skus = Sku::query()
            ->with(['product'])
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
