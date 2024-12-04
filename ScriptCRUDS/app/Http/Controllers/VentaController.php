<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        return view('ventas.index', ['data' => Venta::all()]);
    }

    public function create()
    {
        return view('ventas.create');
    }

    public function store(Request $request)
    {
        Venta::create($request->all());
        return redirect()->route('ventas.index');
    }

    public function show($id)
    {
        $item = Venta::findOrFail($id);
        return view('ventas.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Venta::findOrFail($id);
        return view('ventas.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Venta::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('ventas.index');
    }

    public function destroy($id)
    {
        Venta::destroy($id);
        return redirect()->route('ventas.index');
    }
}