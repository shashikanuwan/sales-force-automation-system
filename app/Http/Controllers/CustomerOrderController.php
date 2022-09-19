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

    public function productSku(Request $request)
    {
        $product = Product::query()->where('id', $request->get('product_id'))->first();
        $productCode = $product->sku->code;
        $unitPrice = round($product->mrp, 2);
        return response()
            ->json([
                'productCode' => $productCode,
                'unitPrice' => $unitPrice
            ]);
    }

    public function freeIssue(Request $request)
    {
        $product = Product::query()->where('id', $request->get('product_id'))->first();
        $quantity = intval($request->get('quantity'));
        $amount = round($product->mrp * $quantity, 2);

        $freeIssue = null;

        if ($request->ajax()) {
            if ($product->linefree) {
                if ($product->linefree->type == "Flat") {
                    if ($product->linefree->lower_limit <= $quantity and $quantity <= $product->linefree->uper_limit) {
                        $freeIssue =  $product->linefree->free_quantity;
                    } else {
                        $freeIssue = "No free issue";
                    }
                } elseif ($product->linefree->lower_limit <= $quantity and $quantity <= $product->linefree->uper_limit) {
                    $freeIssue = intval($quantity / $product->linefree->purchase_quantity * $product->linefree->free_quantity);
                } else {
                    $freeIssue = "No free issue";
                }
            } else {
                $freeIssue = "Free Issue Not Created";
            }
        }

        return response([
            'freeIssue' => $freeIssue,
            'amount' => $amount,
        ]);
    }

    public function invoice(CustomerOrder $customerOrder)
    {
        return view('CustomerOrder.view')
            ->with([
                'customerOrder' => $customerOrder,
                'customerOrderProducts' => CustomerOrderProduct::query()
                    ->with('product')
                    ->where('customer_order_id', $customerOrder->id)
                    ->get()
            ]);
    }
}
