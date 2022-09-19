<?php

namespace App\Http\Controllers\Distributor;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Distributor\DistributorOrderRequest;
use App\Http\Requests\Distributor\DistributorRequest;
use App\Models\DistributorOrderProduct;
use App\Models\Order;

class DistributorOrderController extends Controller
{
    public function create(DistributorRequest $request)
    {
        return view('Distributor.create-order');
    }

    public function store(DistributorOrderRequest $request)
    {
        $number = Helper::IDGenerator(new Order(), 'number', 2, 'ODR');

        $order = new Order();
        $order->number = $number;
        $order->remark = request()->get('remark');
        $order->deliver_date = request()->get('deliver_date');
        $order->user_id = $request->user()->id;
        $order->save();

        $data = $request->get('quantities');

        for ($i = 0; $i < count($data); $i++) {
            $distributorOrderProduct = new   DistributorOrderProduct();
            $distributorOrderProduct->quantity = $request->get('quantities')[$i];
            $distributorOrderProduct->product_id = request('product_ids')[$i];
            $distributorOrderProduct->order_id = $order->id;
            $distributorOrderProduct->save();
        }

        return redirect()
            ->route('distributor.dashboard')
            ->with('success', 'Order has been created');
    }
}
