<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchDistributor extends Component
{
    public Collection $users;

    public function __construct()
    {
        $this->users = User::query()
            ->with(['territory.region.zone'])
            ->orderBy('id', 'DESC')
            ->role('distributor')->get();
    }

    public function render()
    {
        return view('components.fetch-distributor');
    }
}
