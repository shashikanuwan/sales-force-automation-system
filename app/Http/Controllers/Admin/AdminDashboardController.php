<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function __invoke(AdminRequest $request)
    {
        return view('Admin.dashboard')
            ->with([
                'users' => User::query()
                    ->with(['territory.region.zone', 'roles'])
                    ->paginate(5)
            ]);
    }
}
