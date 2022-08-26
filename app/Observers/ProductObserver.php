<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Sku;
use Illuminate\Support\Str;

class ProductObserver
{
    public function created(Product $product)
    {
        $category = Str::limit($product->category->name, 3, '-');
        $name = Str::limit("$product->name", 3, '-');
        $weight = str::lower("$product->weight");
        $mrp =str::lower("$product->mrp");
        $skuCode = Str::upper(Str::slug("$category $name $weight $mrp", '-'));

        $sku  = new Sku();
        $sku->code = $skuCode;
        $sku->product_id = $product->id;
        $sku->save();
    }

    public function updated(Product $product)
    {

    }

    public function deleted(Product $product)
    {

    }

    public function restored(Product $product)
    {

    }

    public function forceDeleted(Product $product)
    {

    }
}
