<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\RegionRequest;
use App\Models\Region;
use App\Models\Zone;

class RegionController extends Controller
{
    public function index(AdminRequest $request, )
    {
        return view('Admin.Region.index');
    }

    public function create(AdminRequest $request, )
    {
        return view('Admin.Region.create');
    }

    public function store(RegionRequest $request)
    {
        $code = Helper::IDGenerator(new Region(), 'code', 2, 'ZON');
        $region = new Region();
        $region->code = $code;
        $region->name = $request->get('name');
        $region->zone_id = $request->get('zone_id');
        $region->save();

        return redirect()
            ->route('region.index')
            ->with('success', 'New region has been created');
    }

    public function edit(AdminRequest $request, Region $region)
    {
        return view('Admin.Region.edit')
            ->with([
                'region' => $region,
                'zones' => Zone::query()->get()
            ]);
    }

    public function update(RegionRequest $request, Region $region)
    {
        $region->update($request->validated());

        return redirect()
            ->route('region.index')
            ->with('success', 'Region has been updated');
    }

    public function destroy(AdminRequest $request, Region $region)
    {
        $region->delete();

        return back()
            ->with('success', 'Region has been deleted');
    }
}
