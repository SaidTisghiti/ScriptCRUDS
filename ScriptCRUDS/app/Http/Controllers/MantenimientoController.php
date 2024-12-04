<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        return view('mantenimientos.index', ['data' => Mantenimiento::all()]);
    }

    public function create()
    {
        return view('mantenimientos.create');
    }

    public function store(Request $request)
    {
        Mantenimiento::create($request->all());
        return redirect()->route('mantenimientos.index');
    }

    public function show($id)
    {
        $item = Mantenimiento::findOrFail($id);
        return view('mantenimientos.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Mantenimiento::findOrFail($id);
        return view('mantenimientos.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Mantenimiento::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('mantenimientos.index');
    }

    public function destroy($id)
    {
        Mantenimiento::destroy($id);
        return redirect()->route('mantenimientos.index');
    }
}