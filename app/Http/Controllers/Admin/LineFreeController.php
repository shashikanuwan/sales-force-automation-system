<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\LineFreeRequest;
use App\Http\Requests\Admin\UpdateLineFreeRequest;
use App\Models\LineFree;

class LineFreeController extends Controller
{
    public function index(AdminRequest $request)
    {
        return view('Admin.LineFree.index');
    }

    public function create(AdminRequest $request)
    {
        return view('Admin.LineFree.create');
    }

    public function store(LineFreeRequest $request)
    {
        LineFree::create($request->validated());

        return redirect()
            ->route('line-free.index')
            ->with('success', 'New Line Free has been created');
    }

    public function edit(LineFree $lineFree)
    {
        return view('Admin.LineFree.edit')
            ->with([
                'lineFree' => $lineFree
            ]);
    }

    public function update(UpdateLineFreeRequest $request, LineFree $lineFree)
    {
        $lineFree->update($request->validated());

        return redirect()
            ->route('line-free.index')
            ->with('success', 'lineFree has been updated');
    }

    public function destroy(AdminRequest $request, LineFree $lineFree)
    {
        $lineFree->delete();

        return back()
            ->with('success', 'Line Free has been deleted');
    }
}
