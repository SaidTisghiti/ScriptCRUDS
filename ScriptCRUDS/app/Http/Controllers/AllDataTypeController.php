<?php

namespace App\Http\Controllers;

use App\Models\AllDataType;
use Illuminate\Http\Request;

class AllDataTypeController extends Controller
{
    public function index()
    {
        return view('all_data_types.index', ['data' => AllDataType::all()]);
    }

    public function create()
    {
        return view('all_data_types.create');
    }

    public function store(Request $request)
    {
        AllDataType::create($request->all());
        return redirect()->route('all_data_types.index');
    }

    public function edit($id)
    {
        $item = AllDataType::findOrFail($id);
        return view('all_data_types.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = AllDataType::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('all_data_types.index');
    }

    public function destroy($id)
    {
        AllDataType::destroy($id);
        return redirect()->route('all_data_types.index');
    }
}