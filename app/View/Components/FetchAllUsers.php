<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchAllUsers extends Component
{
    public Collection $users;

    public function __construct()
    {
        $this->users = User::query()
            ->with(['territory.region.zone'])
            ->get();
    }

    public function render()
    {
        return view('components.fetch-all-users');
    }
}
