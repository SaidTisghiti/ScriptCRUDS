<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index', ['data' => Customer::all()]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        Customer::create($request->all());
        return redirect()->route('customers.index');
    }

    public function show($id)
    {
        $item = Customer::findOrFail($id);
        return view('customers.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Customer::findOrFail($id);
        return view('customers.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Customer::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->route('customers.index');
    }
}