<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('clientes.index', ['data' => Cliente::all()]);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        Cliente::create($request->all());
        return redirect()->route('clientes.index');
    }

    public function show($id)
    {
        $item = Cliente::findOrFail($id);
        return view('clientes.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Cliente::findOrFail($id);
        return view('clientes.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Cliente::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('clientes.index');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('clientes.index');
    }
}