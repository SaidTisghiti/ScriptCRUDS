<?php

namespace App\Http\Controllers;

use App\Models\Coch;
use Illuminate\Http\Request;

class CochController extends Controller
{
    public function index()
    {
        return view('coches.index', ['data' => Coch::all()]);
    }

    public function create()
    {
        return view('coches.create');
    }

    public function store(Request $request)
    {
        Coch::create($request->all());
        return redirect()->route('coches.index');
    }

    public function show($id)
    {
        $item = Coch::findOrFail($id);
        return view('coches.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Coch::findOrFail($id);
        return view('coches.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Coch::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('coches.index');
    }

    public function destroy($id)
    {
        Coch::destroy($id);
        return redirect()->route('coches.index');
    }
}