<?php

namespace App\View\Components;

use App\Helpers\Helper;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateOrder extends Component
{
    public Collection $products;
    public Collection $users;
    public $number;

    public function __construct()
    {
        $this->products = Product::query()
            ->get();

        $this->users = User::query()
            ->with(['territory'])
            ->role('distributor')
            ->get();

        $this->number = Helper::IDGenerator(new Order(), 'number', 2, 'ODR');
    }

    public function render()
    {
        return view('components.create-order');
    }
}
