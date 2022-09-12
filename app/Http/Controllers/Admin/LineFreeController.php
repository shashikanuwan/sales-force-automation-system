<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LineFreeRequest;
use App\Models\LineFree;

class LineFreeController extends Controller
{
    public function index()
    {
        return view('Admin.LineFree.index');
    }

    public function create()
    {
        return view('Admin.LineFree.create');
    }

    public function store(LineFreeRequest $request)
    {
        LineFree::create($request->validated());

        return redirect()
            ->route('line.free.index')
            ->with('success', 'New Line Free has been created');
    }
}
