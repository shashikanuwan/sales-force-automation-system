<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(AdminRequest $request)
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

            $order = new Order();
            $order->createOrder(
                $request->get('remarks')[$i],
                $request->get('quantities')[$i],
                $request->get('user_ids')[$i],
                $request->get('sku_ids')[$i],
                $request->get('deliver_dates')[$i]
            );
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
