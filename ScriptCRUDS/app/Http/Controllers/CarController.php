<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return view('cars.index', ['data' => Car::all()]);
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        Car::create($request->all());
        return redirect()->route('cars.index');
    }

    public function show($id)
    {
        $item = Car::findOrFail($id);
        return view('cars.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Car::findOrFail($id);
        return view('cars.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Car::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('cars.index');
    }

    public function destroy($id)
    {
        Car::destroy($id);
        return redirect()->route('cars.index');
    }
}