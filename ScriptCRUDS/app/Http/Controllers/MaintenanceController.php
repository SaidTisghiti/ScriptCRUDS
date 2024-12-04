<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance.index', ['data' => Maintenance::all()]);
    }

    public function create()
    {
        return view('maintenance.create');
    }

    public function store(Request $request)
    {
        Maintenance::create($request->all());
        return redirect()->route('maintenance.index');
    }

    public function show($id)
    {
        $item = Maintenance::findOrFail($id);
        return view('maintenance.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Maintenance::findOrFail($id);
        return view('maintenance.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Maintenance::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('maintenance.index');
    }

    public function destroy($id)
    {
        Maintenance::destroy($id);
        return redirect()->route('maintenance.index');
    }
}