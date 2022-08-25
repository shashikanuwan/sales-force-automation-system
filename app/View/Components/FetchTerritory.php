<?php

namespace App\View\Components;

use App\Models\Territory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchTerritory extends Component
{
    public Collection $territories;

    public function __construct()
    {
        $this->territories = Territory::query()
        ->with('region', 'region.zone')
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function render()
    {
        return view('components.fetch-territory');
    }
}
