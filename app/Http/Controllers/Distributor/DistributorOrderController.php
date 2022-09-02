<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Distributor\DistributorOrderRequest;
use App\Models\Order;

class DistributorOrderController extends Controller
{
    public function create()
    {
        return view('Distributor.create-order');
    }

    public function store(DistributorOrderRequest $request)
    {
        $data = $request->get('quantities');

        for ($i = 0; $i < count($data); $i++) {

            $order = new Order();
            $order->createOrder(
                $request->get('remarks')[$i],
                $request->get('quantities')[$i],
                $request->user()->id,
                $request->get('sku_ids')[$i],
                $request->get('deliver_dates')[$i]
            );
        }

        return redirect()
            ->route('distributor.dashboard')
            ->with('success', 'Order has been created');
    }
}
