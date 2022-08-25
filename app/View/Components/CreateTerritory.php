<?php

namespace App\View\Components;

use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateTerritory extends Component
{
    public Collection $regions;

    public function __construct()
    {
        $this->regions = Region::query()->get();
    }

    public function render()
    {
        return view('components.create-territory');
    }
}
