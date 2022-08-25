<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;

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

    public function store(ProductRequest $request, Product $product)
    {
        $product->create($request->validated());

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
