<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('Admin.Product.index');
    }

    public function create()
    {
        return view('Admin.Product.create');
    }

    public function store(ProductRequest $request)
    {
        $p = Product::create($request->validated());

        $category = Str::limit($p->category->name, 3, '-');
        $name = Str::limit("$p->name", 3, '-');
        $weight = str::lower("$p->weight");
        $mrp =str::lower("$p->mrp");
        $skuCode = Str::upper(Str::slug("$category $name $weight $mrp", '-'));

        $sku  = new Sku();
        $sku->code = $skuCode;
        $sku->product_id = $p->id;
        $sku->save();

        return redirect()
            ->route('product.index')
            ->with('success', 'New Product has been created');
    }

    public function edit(AdminRequest $request, Product $product)
    {
        return view('Admin.Product.edit')
            ->with([
                'product' => $product,
                'categories' => Category::query()->get()
            ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('product.index')
            ->with('success', 'Product has been updated');
    }

    public function destroy(AdminRequest $request, Product $product)
    {
        $product->delete();

        return back()
            ->with('success', 'Product has been deleted');
    }
}
