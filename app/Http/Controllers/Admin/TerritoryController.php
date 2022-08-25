<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\TerritoryRequest;
use App\Models\Region;
use App\Models\Territory;

class TerritoryController extends Controller
{

    public function index(AdminRequest $request)
    {
        return view('Admin.Territory.index');
    }

    public function create(AdminRequest $request)
    {
        return view('Admin.Territory.create');
    }

    public function store(TerritoryRequest $request)
    {
        $code = Helper::IDGenerator(new Territory(), 'code', 2, 'ZON');
        $territory = new Territory();
        $territory->code = $code;
        $territory->name = $request->get('name');
        $territory->region_id = $request->get('region_id');
        $territory->save();

        return redirect()
            ->route('territory.index')
            ->with('success', 'New territory has been created');
    }

    public function edit(Territory $territory)
    {
        return view('Admin.Territory.edit')
            ->with([
                'territory' => $territory,
                'regions' => Region::query()->get()
            ]);
    }

    public function update(TerritoryRequest $request, Territory $territory)
    {
        $territory->update($request->validated());

        return redirect()
            ->route('territory.index')
            ->with('success', 'Territory has been updated');
    }

    public function destroy(AdminRequest $request, Territory $territory)
    {
        $territory->delete();

        return back()
            ->with('success', 'Territory has been deleted');
    }
}
