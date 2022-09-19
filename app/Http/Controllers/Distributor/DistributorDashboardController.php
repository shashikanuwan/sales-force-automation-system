<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Distributor\DistributorRequest;
use App\Models\Order;

class DistributorDashboardController extends Controller
{
    public function __invoke(DistributorRequest $request)
    {
        return view('Distributor.dashboard')
            ->with([
                'orders' =>  Order::query()
                    ->where('user_id', $request->user()->id)
                    ->with('distributorOrderProducts.product')
                    ->orderBy('id', 'DESC')
                    ->paginate(10)
            ]);
    }
}
