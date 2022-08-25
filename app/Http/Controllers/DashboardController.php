<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return redirect()->route($this->getRouteForUser($request->user()));
    }

    private function getRouteForUser(User $user): string
    {
        if ($user->isAdmin()) {
            return 'admin.dashboard';
        }

        if ($user->isDistributor()) {
            return 'distributor.dashboard';
        }
    }
}
