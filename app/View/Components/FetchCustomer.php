<?php

namespace App\View\Components;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchCustomer extends Component
{
    public Collection $customers;

    public function __construct()
    {
        $this->customers = Customer::query()
            ->with(['distributor'])
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('components.fetch-customer');
    }
}
