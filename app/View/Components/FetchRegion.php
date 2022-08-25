<?php

namespace App\View\Components;

use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchRegion extends Component
{
    public Collection $regions;

    public function __construct()
    {
        $this->regions = Region::query()
            ->with('zone')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('components.fetch-region');
    }
}
