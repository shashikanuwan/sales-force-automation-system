<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\OrderRequest;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Models\DistributorOrderProduct;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(AdminRequest $request)
    {
        return view('Order.index')
            ->with([
                'orders' =>  Order::query()
                    ->with('user.territory', 'distributorOrderProducts.product')
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
        $number = Helper::IDGenerator(new Order(), 'number', 2, 'ODR');

        $order = new Order();
        $order->number = $number;
        $order->remark = request()->get('remark');
        $order->deliver_date = request()->get('deliver_date');
        $order->user_id = request()->get('user_id');
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

    public function update(UpdateOrderRequest $request,  Order $order)
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
