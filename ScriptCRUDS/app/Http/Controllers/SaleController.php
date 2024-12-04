<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('sales.index', ['data' => Sale::all()]);
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
    {
        Sale::create($request->all());
        return redirect()->route('sales.index');
    }

    public function show($id)
    {
        $item = Sale::findOrFail($id);
        return view('sales.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Sale::findOrFail($id);
        return view('sales.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Sale::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('sales.index');
    }

    public function destroy($id)
    {
        Sale::destroy($id);
        return redirect()->route('sales.index');
    }
}