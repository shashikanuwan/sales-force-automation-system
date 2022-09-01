<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('Order.index')
            ->with([
                'orders' =>  Order::query()
                    ->with(['sku.product', 'user.territory.region'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10)
            ]);
    }

    public function create(AdminRequest $request)
    {
        return view('Order.create');
    }

    public function store(OrderRequest $request)
    {
        $data = $request->get('quantities');

        for ($i = 0; $i < count($data); $i++) {

            $number = Helper::IDGenerator(new Order(), 'number', 2, 'ODR');

            $order = new Order();
            $order->number = $number;
            $order->remark = $request->get('remarks')[$i];
            $order->quantity = $request->get('quantities')[$i];
            $order->user_id = $request->get('user_ids')[$i];
            $order->sku_id = $request->get('sku_ids')[$i];
            $order->deliver_date = $request->get('deliver_dates')[$i];
            $order->save();
        }

        return redirect()
            ->route('order.index')
            ->with('success', 'Order has been created');
    }

    public function show(Order $order)
    {
        return view('Order.show')
            ->with(['order' => $order]);
    }

    public function edit(AdminRequest $request, Order $order)
    {
        return view('Order.edit')
            ->with(['order' => $order,]);
    }

    public function update(OrderRequest $request,  Order $order)
    {
        $order->update($request->validated());

        return redirect()
            ->route('order.index')
            ->with('success', 'Order has been updated');
    }

    public function destroy(AdminRequest $request, Order $order)
    {
        $order->delete();

        return redirect()
            ->route('order.index')
            ->with('success', 'order has been deleted');
    }
}
