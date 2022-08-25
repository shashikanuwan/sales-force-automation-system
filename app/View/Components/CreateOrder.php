<?php

namespace App\View\Components;

use App\Models\Sku;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateOrder extends Component
{
    public Collection $skus;
    public Collection $users;

    public function __construct()
    {
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
        return view('components.create-order');
    }
}
