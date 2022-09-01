<?php

namespace App\Http\Controllers\Distributor;

use App\Helpers\Helper;
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

            $number = Helper::IDGenerator(new Order(), 'number', 2, 'ODR');

            $order = new Order();
            $order->number = $number;
            $order->remark = $request->get('remarks')[$i];
            $order->quantity = $request->get('quantities')[$i];
            $order->user_id = $request->user()->id;
            $order->sku_id = $request->get('sku_ids')[$i];
            $order->deliver_date = $request->get('deliver_dates')[$i];
            $order->save();
        }

        return redirect()
            ->route('distributor.dashboard')
            ->with('success', 'Order has been created');
    }
}
