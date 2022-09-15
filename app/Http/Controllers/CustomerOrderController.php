<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerOrderRequest;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderProduct;

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
}
