<?php

namespace App\View\Components;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CreateCustomerOrder extends Component
{
    public Collection $customers;
    public Collection $products;

    public function __construct()
    {
        $this->customers = Customer::query()->where('user_id', Auth::user()->id)->get();
        $this->products = Product::query()->get();
    }

    public function render()
    {
        return view('components.create-customer-order');
    }
}
