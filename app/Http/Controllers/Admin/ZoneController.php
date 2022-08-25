<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\ZoneRequest;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function index(AdminRequest $request, )
    {
        return view('Admin.Zone.index');
    }

    public function create()
    {
        return view('Admin.Zone.create');
    }

    public function store(ZoneRequest $request)
    {
        $code = Helper::IDGenerator(new Zone, 'code', 2, 'ZON');
        $zone = new Zone();
        $zone->code = $code;
        $zone->name = $request->get('name');
        $zone->description = $request->get('description');
        $zone->save();

        return redirect()
            ->route('zone.index')
            ->with('success', 'New zone has been created');
    }

    public function edit(AdminRequest $request, Zone $zone)
    {
        return view('Admin.Zone.edit')
            ->with(['zone' => $zone]);
    }

    public function update(ZoneRequest $request, Zone $zone)
    {
        $zone->update($request->validated());

        return redirect()
            ->route('zone.index')
            ->with('success', 'Zone has been updated');
    }

    public function destroy(AdminRequest $request, Zone $zone)
    {
        $zone->delete();

        return back()
            ->with('success', 'Zone has been deleted');
    }
}
