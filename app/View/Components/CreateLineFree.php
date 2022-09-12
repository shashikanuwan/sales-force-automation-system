<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateLineFree extends Component
{
    public Collection $products;

    public function __construct()
    {
        $this->products = Product::query()->get();
    }

    public function render()
    {
        return view('components.create-line-free');
    }
}
