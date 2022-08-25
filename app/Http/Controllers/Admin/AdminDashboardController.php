<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;

class AdminDashboardController extends Controller
{
    public function __invoke(AdminRequest $request)
    {
        return view('Admin.dashboard');
    }
}
