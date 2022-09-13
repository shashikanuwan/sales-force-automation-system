<?php

namespace App\View\Components;

use App\Models\LineFree;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchLineFree extends Component
{
    public Collection $linefrees;

    public function __construct()
    {
        $this->linefrees = LineFree::query()
            ->with('product')
            ->orderBy('id', 'DESC')
            ->get();
    }
    public function render()
    {
        return view('components.fetch-line-free');
    }
}
