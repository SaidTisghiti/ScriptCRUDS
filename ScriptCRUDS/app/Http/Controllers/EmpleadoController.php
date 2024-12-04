<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        return view('empleados.index', ['data' => Empleado::all()]);
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        Empleado::create($request->all());
        return redirect()->route('empleados.index');
    }

    public function show($id)
    {
        $item = Empleado::findOrFail($id);
        return view('empleados.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Empleado::findOrFail($id);
        return view('empleados.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Empleado::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('empleados.index');
    }

    public function destroy($id)
    {
        Empleado::destroy($id);
        return redirect()->route('empleados.index');
    }
}