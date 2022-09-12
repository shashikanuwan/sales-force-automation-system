<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateCustomer extends Component
{
    public Collection $distributors;

    public function __construct()
    {
        $this->distributors = User::query()->role('distributor')->get();
    }

    public function render()
    {
        return view('components.create-customer');
    }
}
