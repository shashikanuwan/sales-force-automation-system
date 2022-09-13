<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerOrderRequest;
use App\Models\CustomerOrder;

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
        $data = $request->get('quantities');

        for ($i = 0; $i < count($data); $i++) {

            $customerOrder = new CustomerOrder();
            $customerOrder->createOrder(
                $request->get('quantities')[$i],
                $request->get('customer_ids')[$i],
                $request->get('product_ids')[$i],
                $request->get('deliver_dates')[$i]
            );
        }

        return redirect()
            ->route('customer-order.index')
            ->with('success', 'Customer Order has been created');
    }
}
