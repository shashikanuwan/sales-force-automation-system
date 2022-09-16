<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerOrderRequest;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index()
    {
        return view('CustomerOrder.index');
    }

    public function create()
    {
        return view('CustomerOrder.create');
    }

    public function store(CustomerOrderRequest $request)
    {
        $customerOrder = new CustomerOrder();
        $customerOrder->createOrder(
            $request->get('customer_id'),
            $request->get('deliver_date')
        );

        $data = $request->get('quantities');

        for ($i = 0; $i < count($data); $i++) {
            $customerOrderProduct = new CustomerOrderProduct();
            $customerOrderProduct->quantity = $request->get('quantities')[$i];
            $customerOrderProduct->customer_order_id = $customerOrder->id;
            $customerOrderProduct->product_id = request('product_ids')[$i];
            $customerOrderProduct->save();
        }

        return redirect()
            ->route('customer-order.index')
            ->with('success', 'Customer Order has been created');
    }

    public function calculate(Request $request)
    {
        $product = Product::query()->where('id', $request->get('product_id'))->first();
        $quantity = intval($request->get('quantity'));

        if ($request->ajax()) {
            if ($product->linefree) {
                if ($product->linefree->type == "Flat") {
                    if ($product->linefree->lower_limit <= $quantity and $quantity <= $product->linefree->uper_limit) {
                        return response()->json($product->Linefree->free_quantity);
                    }
                    return response("No free issue");
                }
                if ($product->linefree->lower_limit <= $quantity and $quantity <= $product->linefree->uper_limit) {
                    return response()->json(intval($quantity / $product->linefree->purchase_quantity * $product->linefree->free_quantity));
                }
                return response("No free issue");
            }
            return response("Free Issue Not Created");
        }
    }
}