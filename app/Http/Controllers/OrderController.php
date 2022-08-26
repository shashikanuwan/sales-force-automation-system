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
        return view('Order.index');
    }

    public function create(AdminRequest $request)
    {
        return view('Order.create');
    }

    public function store(OrderRequest $request)
    {
        $number = Helper::IDGenerator(new Order(), 'number', 2, 'ODR');

        $order = new Order();
        $order->number = $number;
        $order->remark = $request->get('remark');
        $order->quantity = $request->get('quantity');
        $order->user_id = $request->get('user_id');
        $order->sku_id = $request->get('sku_id');
        $order->save();

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

        return back()
            ->with('success', 'order has been deleted');
    }
}
