<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\distributorRequest;
use App\Models\Role;
use App\Models\Territory;
use App\Models\User;

class distributorController extends Controller
{
    public function index(AdminRequest $request)
    {
        return view('Admin.Distributor.index');
    }

    public function create(AdminRequest $request)
    {
        return view('Admin.Distributor.create');
    }

    public function store(distributorRequest $request, User $user)
    {
        $user->create($request->validated())->assignRole(Role::ROLE_DISTRIBUTOR);

        return redirect()
            ->route('distributor.index')
            ->with('success', 'New Distributor has been created');
    }

    public function edit(AdminRequest $request, User $user)
    {
        dd($user);
        return view('Admin.Distributor.edit')
        ->with([
            'user' => $user,
            'territories' => Territory::query()->get()
        ]);
    }

    public function update(DistributorRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()
            ->route('distributor.index')
            ->with('success', 'Distributor has been updated');
    }

    public function destroy(AdminRequest $request, User $user)
    {
        $user->delete();

        return back()
            ->with('success', 'Distributor has been deleted');
    }
}
