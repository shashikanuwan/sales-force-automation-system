<?php

namespace App\View\Components;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateRegion extends Component
{
    public Collection $zones;

    public function __construct()
    {
        $this->zones = Zone::query()->get();
    }

    public function render()
    {
        return view('components.create-region');
    }
}
