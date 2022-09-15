<?php

namespace App\View\Components;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\CustomerOrder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CreateCustomerOrder extends Component
{
    public Collection $customers;
    public Collection $orders;
    public $number;

    public function __construct()
    {
        $this->customers = Customer::query()->where('user_id', Auth::user()->id)->get();
        $this->orders = Auth::user()->orders;
        $this->number = Helper::IDGenerator(new CustomerOrder(), 'number', 2, 'CUST_ODR');
    }

    public function render()
    {
        return view('components.create-customer-order');
    }
}
