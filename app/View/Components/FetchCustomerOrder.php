<?php

namespace App\View\Components;

use App\Models\CustomerOrder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class FetchCustomerOrder extends Component
{
    public Collection $customerOrders;

    public function __construct()
    {
        $this->customerOrders = CustomerOrder::query()
            ->ofThisUser(Auth::user())
            ->with('customerOrderProducts.product')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('components.fetch-customer-order');
    }
}
