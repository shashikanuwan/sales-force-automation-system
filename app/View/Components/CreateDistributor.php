<?php

namespace App\View\Components;

use App\Models\Territory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateDistributor extends Component
{
    public Collection $territories;

    public function __construct()
    {
        $this->territories = Territory::query()->get();
    }

    public function render()
    {
        return view('components.create-distributor');
    }
}
