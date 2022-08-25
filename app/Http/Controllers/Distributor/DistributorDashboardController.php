<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Distributor\DistributorRequest;

class DistributorDashboardController extends Controller
{
    public function __invoke(DistributorRequest $request)
    {
        return view('Distributor.dashboard');
    }
}
