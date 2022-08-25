<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FetchProduct extends Component
{
    public Collection $products;

    public function __construct()
    {
        $this->products = Product::query()
            ->with(['category', 'sku'])
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('components.fetch-product');
    }
}
